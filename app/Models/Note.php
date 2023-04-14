<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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


    // HINT: Define an inverse relationship to be able to query a user from a 
    // note.

    // NOTE: The method name matches the User Model and it's in singular.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
