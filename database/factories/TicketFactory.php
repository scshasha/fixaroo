<?php

use App\User;
use App\Ticket;
use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Ticket::class, function (Faker $faker) {

    // @TODO: user_id must change to asignee_id or agent_id or asigned_to_id

    // User::all()->random()->id
    // Category::where('name', 'Uncategorized')->firstOrFail()->id,

    $priority = array('low','medium','high');
    return [
        "title" => $faker->sentence,
        "message" => $faker->paragraph,
        "priority" => $priority[$faker->numberBetween(0, 2)],
        "status" => "Open",
        "user_id" => $faker->numberBetween(2, 6),
        "ticket_id" => strtoupper(Str::random(15)),
        "category_id" => Category::all()->random()->id,
        "author_name" => $faker->name,
        "author_email" => $faker->email,
    ];
});
