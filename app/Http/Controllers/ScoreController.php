<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function eredmenyem(Request $request)
    {
        $email = $request->query('email');
        if (!$email) {
            abort(403, 'Email is required'); // Ha az email hiányzik, hibát dob
        }

        $results = Score::where('email', $email)->with('question.answers')->get(); // Eredmények lekérdezése
        $totalScore = $results->sum('question.score');
        $obtainedScore = $results->sum('score');
        $percentage = $totalScore > 0 ? ($obtainedScore / $totalScore) * 100 : 0;

        return view('results.index', compact('results', 'totalScore', 'obtainedScore', 'percentage')); // Eredmények megjelenítése
    }

    public function listEredmenyek(Request $request)
    {
        $query = Score::with('question', 'subject');

        // Szűrés email cím alapján
        if ($request->has('email')) {
            $query->where('email', $request->input('email'));
        }

        // Szűrés tantárgy alapján
        if ($request->has('subject_id')) {
            $query->where('subject_id', $request->input('subject_id'));
        }

        // Szűrés kapott pontszám alapján
        if ($request->has('min_score')) {
            $query->where('score', '>=', $request->input('min_score'));
        }
        if ($request->has('max_score')) {
            $query->where('score', '<=', $request->input('max_score'));
        }

        $results = $query->get(); // Eredmények lekérdezése
        return view('results.list', compact('results')); // Eredmények listázása
    }
}
