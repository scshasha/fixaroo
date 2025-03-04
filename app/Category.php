<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = array(
        'name'
    );

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
