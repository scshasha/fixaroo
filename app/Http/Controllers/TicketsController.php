<?php

namespace App\Http\Controllers;

use App\Mail\TicketCreatedMail;
use App\Mail\TicketStatusMail;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TicketsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth'); Need to allow non-registered users to make and view thier tickets.
    }

    public function index()
    {
        if (Auth::user()) {
            if (Auth::user()->is_admin === 1) {
                $tickets = Ticket::paginate(10);
                $categories = Category::all();
                $agents = User::all()->where('is_admin', 2);

                return view('admin.tickets', compact('tickets', 'categories', 'agents'));
            } elseif (Auth::user()->is_admin === 2) {
                $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);
                $categories = Category::all();

                return view('agent.tickets', compact('tickets', 'categories'));
            }
        }
        return redirect('/home')->with('error', 'Unauthorized.');
    }


    public function create()
    {
        return view('tickets.create', [
            'categories' => Category::all()->all()
        ]);
    }



    // public function store(Request $request, AppMailer $mailer) // No longer using AppMailer::class
    public function store(Request $request)
    {
        $to = $input = [];

        // Get Administrator E-mails to Notify
        $a = User::all()->where('is_admin', 1);

        foreach ($a as $b) {
            $to[] = $b->email;
        }

        // Validate Input
        $this->validate($request, [
            'title'     => 'required',
            'author_name'  =>  'required',
            'author_email'   =>  'required|email',
            'message'  =>  'required',
        ]);

        $input = [
            'title'         =>  $request->input('title'),
            'ticket_id'     =>  strtoupper(Str::random(15)),
            'message'       =>  $request->input('message'),
            'author_name'   =>  $request->input('author_name'),
            'author_email'  =>  $request->input('author_email'),
            'category_id'   =>  Category::where('name', 'Uncategorized')->firstOrFail()->id,
            'priority'      =>  'low',
            'status'        =>  "Open",
        ];

        $ticket = new Ticket($input);
        $ticket->save();

        /**
         * Send notification to an administrator about the newly created ticket.
         *
         * @TODO: Update implementation. Although for now we are assuming that there is only one administrator
         *        We need to update the e-mailing functionality to also work for multiple admins.
         */

        $adminEmail = User::where('is_admin', 1)->firstOrFail()->email;
        // dd($adminEmail);
        $data = [
            'email_template' => 'admin','email_subject' => 'New support ticket.'
        ];

        // Send notification to administrator.
        if ($adminEmail) {
            Mail::to($adminEmail)->send(new TicketCreatedMail($data, $ticket));
        }

        // Send notifcation to the ticket author.
        $data = [
            'email_template' => 'author','email_subject' => 'Ticket submitted.'
        ];
        Mail::to($ticket->author_email)->send(new TicketCreatedMail($data, $ticket));

        // Response message.
                $responseMessage = sprintf('Your ticket has been successfully submitted. We will be in touch soon. You can view the status of your ticket <a href="%s/tickets/%s" target="_blank"> here <i class="fa fa-external-link"></i></a>.', env('APP_URL'), $ticket->ticket_id);

        return redirect()->back()->with("status", $responseMessage);
    }


    // public function show(Ticket $ticket, $ticket_id)
    public function show($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        // $category = $ticket->category;
        $categories = Category::all();
        $comments = $ticket->comments;
        $users = User::all()->where('is_admin', 2);
        $viewData = compact('ticket', 'categories', 'comments', 'users');

        if (Auth::user() && Auth::user()->is_admin === 1) {
            return view('admin.ticket-details', $viewData);
        } elseif (Auth::user() && Auth::user()->is_admin === 2) {
            return view('agent.ticket-details', $viewData);
        }

        return view('tickets.single', $viewData);
    }

    public function showByCurrentUser()
    {

        // $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);
        // $categories = Category::all();
        // $viewData = compact('tickets', 'categories');

        // return view('tickets.list-user', $viewData);
    }

    public function close($ticket_id)
    {

        /**
         * Ony allowing authenticated users to ation the status update.
         *
         * Restricting status update to only administrator(s) and assigned agent(s)
         *
         * @TODO: Update e-mail functionality.
         */
        $closeTicket = false;
        $notify = ['agent' => false,'admin' => false,'author' => true]; //Flags to know whom to e-mail of this action.
        if (Auth::user()) {
            // Get the ticket to close.
            $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

            if (Auth::user()->is_admin === 1) {
                $closeTicket = true;
                $notify['agent'] = true;
            } elseif (Auth::user()->is_admin === 2) {
                $notify['admin'] = true;
                // Check if agent is assigned to this ticket.
                if ($ticket->user_id === Auth::user()->id) {
                    $closeTicket = true;
                }
            }

            if ($closeTicket) {
                $ticket->status = 'Closed';
                $ticket->save();
                /**
                 * App\Mail\TicketStatusMail expects parameter 2 to be a User instance.
                 * Therefore create such instance from ticket object data.
                 *
                 * @TODO: Refactor emailing logic.
                 */
                $author = new User();
                $author->name = $ticket->author_name;
                $author->email = $ticket->author_email;

                Mail::to(
                    $author->email
                )->send(new TicketStatusMail($ticket, $author));

                return redirect()->back()->with("status", "Ticket closed.");
            }
        }
    }


    // public function edit(Ticket $ticket)
    public function edit($ticket_id)
    {
        /**
         * To edit user ned to be logged in and HAS to be an administrator.
         */
        if (Auth::user() && Auth::user()->is_admin === 1) {
            $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
            $agents = User::all()->where('is_admin', 2);
            $categories = Category::all();

            return view('admin.ticket-edit', compact('ticket', 'categories', 'agents'));
        }

        return redirect()->back()->with("error", "You are not authorized to perform this action.");
    }

    public function update(Request $request, Ticket $ticket)
    {
        if (Auth::user() && Auth::user()->is_admin) {
            $this->validate($request, [
                'priority'  =>  'required',
                'status'  =>  'required',
                'category_id'  =>  'required',
            ]);

            $input = [
                'category_id'   =>  $request->input('category_id'),
                'priority'      =>  $request->input('priority'),
                'user_id'        =>  !empty($request->input('user_id')) ? $request->input('user_id') : null,
                'status'        =>  $request->input('status'),
                'ticket_id'        =>  $request->input('ticket_id'),
            ];
            // dd($input);

            $ticket = Ticket::where('ticket_id', $input['ticket_id'])->firstOrFail();
            // Check if we should notify agent.
            if (!empty($input['user_id'])) {
                if ($ticket->user_id !== $input['user_id']) {
                    $agentEmail = User::where('id', $input['user_id'])->firstOrFail()->email;
                    $data = ['email_template' => "agent", 'email_subject' => "Assigned To A Ticket."];
                    Mail::to($agentEmail)->send(new \App\Mail\TicketAssignedMail($data, $ticket));
                }
            }


            // $ticket->title = $input['title'];
            // $ticket->ticket_id = $input['ticket_id'];
            // $ticket->message = $input['message'];
            $ticket->category_id = $input['category_id'];
            $ticket->priority = $input['priority'];
            $ticket->status = $input['status'];
            $ticket->user_id = $input['user_id'];

            $ticket->save();

            return redirect('/admin/tickets/edit/' . $ticket->ticket_id)->with('status', 'Ticket has been updated');
        }
    }

    public function destroy($ticket_id)
    {
        /**
         * Check if the deleting user is logged in.
         *
         * Restrict deleting to an administrator user.
         */

        if (Auth::user()) {
            if (Auth::user()->is_admin && Auth::user()->is_admin === 1) {
                // Remove the ticket.
                Ticket::where('ticket_id', $ticket_id)->delete();
                return redirect('/admin/tickets')->with('status', sprintf('Ticket <strong>#%s</strong> has been sucessfully removed.', $ticket_id));
            }
        }
        return redirect()->back() - with('errors', 'Action not allowed.');
    }
}
