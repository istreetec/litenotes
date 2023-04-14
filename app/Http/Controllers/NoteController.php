<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

// see - https://laravel.com/docs/10.x/controllers#actions-handled-by-resource-controller

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Query related Models.
        // Get Authenticated user's notes
        // $notes = Auth::user()->notes()->latest("updated_at")->paginate(2);

        // Using inverse relationship alternative
        $notes = Note::whereBelongsTo(Auth::user())->latest("updated_at")->paginate(2);

        // Pass the payload to the view to display
        return view("notes.index")->with("notes", $notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view("notes.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate individual form fields
        // see - https://laravel.com/docs/10.x/validation#available-validation-rules
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required',
        ]);

        $sanitizeText = trim($request->text);

        // Save the data
        // TIP: Using relationship when creating a note exempts manually setting 
        // the foreign key
        Auth::user()->notes()->create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'text' => $sanitizeText
        ]);

        // Redirect
        return to_route("notes.index");
    }

    /**
     * Display the specified resource.
     */

    // TIP: Route Model Binding pattern
    // inject the actual Note Model's instance into the route
    public function show(Note $note): View
    {
        // Compare Primary Keys of two objects belonging to the same user
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        return view("notes.show")->with("note", $note);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        $notAuth = $note->user_id != Auth::id();
        return $notAuth ? abort(403) : view("notes.edit")->with("note", $note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note): RedirectResponse
    {
        // Complete the edit step by updating Model

        // First check whether the note belongs to logged in user
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        // TIP: Always validate first
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required',
        ]);

        $note->update([
            'title' => $request->title,
            'text' => $request->text,
        ]);

        // Redirect with update note
        $message = "Note updated successfully!";

        // Show Flash data to users
        return to_route("notes.show", $note)->with("success", $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note): RedirectResponse
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        // Nuke the note
        $note->delete();

        $message = "Note deleted successfully!";
        return to_route("notes.index")->with("success", $message);
    }
}
