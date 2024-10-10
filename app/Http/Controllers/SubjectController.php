<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function create()
    {
        return view('subjects.create'); // Új tantárgy hozzáadásának űrlapja
    }

    public function store(Request $request)
    {
        $request->validate(['subject' => 'required|string|max:255']);
        Subject::create($request->all()); // Új tantárgy létrehozása
        return redirect()->back()->with('success', 'Subject successfully added.'); // Visszajelzés
    }
}
