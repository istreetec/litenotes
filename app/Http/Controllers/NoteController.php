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
        // Get logged in user id
        $userId = Auth::id();

        // Fetch the content from the database 

        // Add pagination via Laravel Eloquent
        $notes = Note::where("user_id", $userId)->latest("updated_at")->paginate(
            // Items per page
            2
        );

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
        Note::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
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
        if ($note->user_id != Auth::id()) {
            // Not the logged in user's note
            return abort(403);
        }

        return view("notes.show")->with("note", $note);
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
