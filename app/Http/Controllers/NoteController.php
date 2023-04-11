<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// see - https://laravel.com/docs/10.x/controllers#actions-handled-by-resource-controller

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        // Get logged in user id
        $userId = Auth::id();

        // Fetch the content from the database 
        $notes = Note::where("user_id", $userId)->get();

        // Pass the payload to the view to display
        dd($notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
