<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TrashedNoteController extends Controller
{
    public function index(): View
    {
        // TIP: notice the onlyTrashed()
        $notes = Note::whereBelongsTo(Auth::user())
            ->onlyTrashed()
            ->latest("updated_at")
            ->paginate(2);

        // Pass the payload to the view to display
        return view("notes.index")->with("notes", $notes);
    }

    public function show(Note $note): View
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        return view("notes.show")->with("note", $note);
    }

    public function update(Note $note): RedirectResponse
    {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        // Restore a note
        $note->restore();

        $message = "Note was restored";
        return to_route("notes.show", $note)->with("success", $message);
    }
}
