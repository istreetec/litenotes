<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
