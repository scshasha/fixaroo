<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use App\Comment;
use App\Mail\TicketCommentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommentsController extends Controller
{
    public function __construt()
    {
        $this->middleware('auth');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeComment(Request $request)
    {

        // Request Validation.
        $this->validate($request, [
            'comment' => 'required'
        ]);

        if (Auth::user()) {
            $comment = Comment::create([
                'comment' => $request->input('comment'),
                'ticket_id' => $request->input('ticket_id'),
                'user_id' => Auth::user()->id,
            ]);

            $assignedAgent = null;
            /**
             * See if this ticket has been assigned to an agent.
             *
             * See who is making this comment. We do not want to email the user
             * making this comment.
             *
             * If an agent is assigned we do not want to email them if they are
             * the one making this comment.
             */
            if ($comment->ticket->user_id !== null) {
                $id = $comment->ticket->user_id;
                $assignedAgent = User::where('id', $id)->firstOrFail();
                $toEmail = $assignedAgent->email; // This may change.
            }

            if ($assignedAgent !== null) {
                if ($assignedAgent->id !== Auth::user()->id) {

                    /**
                     * We can now e-mail ticket author and assigned agent about the newly added comment.
                     *
                     * What if its the ticket author making the comment?
                     * - For now we are not worried if this was the ticket author making
                     * - the comment. We intend to e-mail the ticket author of every change that
                     * - happens on this ticket including changes made by them.
                     */

                    $emails = [$assignedAgent->email, $comment->ticket->author_email];
                } else {
                    // Just e-mailing the ticket author.
                    $emails = [$comment->ticket->author_email]; // @TODO: Add administrator.
                }
            } else {
                // Just e-mailing the ticket author.
                $emails = [$comment->ticket->author_email]; // @TODO: Add administrator.
            }
            foreach ($emails as $key => $value) {
                Mail::to($value)->send(new TicketCommentMail(Auth::user(), $comment->ticket, $comment));
            }

            return redirect()->back()->with('status', 'Your comment has been submitted.');
        }
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
