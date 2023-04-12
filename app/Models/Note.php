<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    // Security::
    // protect against Mass Assignment

    // see - https://laravel.com/docs/10.x/eloquent#mass-assignment

    // NOTE: allow all fields to be mass assigned by assigning an empty array

    // TIP: Don't do this in production
    protected $guarded = [];


    // Specify the key to be used to resolve a Model
    // Useful when using Route Model Binding pattern
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
