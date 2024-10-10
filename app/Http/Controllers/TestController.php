<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Score;
use App\Models\Subject;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function showTesztForm()
    {
        $subjects = Subject::all(); // Minden tantárgy lekérdezése
        return view('tests.index', compact('subjects')); // Teszt választó forma megjelenítése
    }

    public function startTeszt($tantargy)
    {
        $subjectModel = Subject::where('name', $tantargy)->firstOrFail(); // Tantárgy lekérdezése
        $questions = Question::with('answers')->where('subject_id', $subjectModel->id)->get(); // Kérdések lekérdezése

        return view('tests.test', compact('subjectModel', 'questions')); // Teszt megjelenítése
    }

    public function submitTeszt(Request $request)
    {
        // A beküldött teszt kezelése
        $email = $request->input('email');
        $subjectId = $request->input('subject_id');
        $totalScore = 0;
        $obtainedScore = 0;

        // Válaszok kiértékelése
        foreach ($request->input('answers') as $questionId => $answerId) {
            $question = Question::findOrFail($questionId);
            $answer = $question->answers()->where('id', $answerId)->first();
            $isCorrect = $answer->is_correct;
            $score = $isCorrect ? $question->score : 0;

            Score::create([
                'email' => $email,
                'subject_id' => $subjectId,
                'question_id' => $questionId,
                'answer_id' => $answerId,
                'is_correct' => $isCorrect,
                'score' => $score,
            ]);

            $totalScore += $question->score;
            $obtainedScore += $score;
        }

        return redirect()->route('showResult', ['email' => $email]); // Eredmények megjelenítése
    }
}
