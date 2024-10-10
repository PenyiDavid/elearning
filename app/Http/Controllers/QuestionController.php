<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create()
    {
        $subjects = Subject::all(); // Minden tantárgy lekérdezése
        return view('questions.create', compact('subjects')); // Új kérdés űrlap
    }

    public function store(Request $request)
    {
        $request->validate(['question' => 'required|string|max:255', 'subject_id' => 'required']);

        $question = Question::create([
            'question' => $request->input('question'),
            'subject_id' => $request->input('subject_id'),
            'score' => $request->input('score'),
        ]);

        foreach ($request->input('answers') as $answerData) {
            Answer::create([
                'question_id' => $question->id,
                'answer' => $answerData['answer'],
                'is_correct' => $answerData['is_correct'],
            ]);
        }

        return redirect()->back()->with('success', 'New question successfully added.'); // Visszajelzés
    }

    public function index()
    {
        $questions = Question::with('subject')->get(); // Kérdések lekérdezése
        return view('questions.index', compact('questions')); // Kérdések listázása
    }

    public function edit($id)
    {
        $question = Question::with('answers')->findOrFail($id); // Kérdés lekérdezése
        $subjects = Subject::all(); // Tantárgyak lekérdezése
        return view('questions.edit', compact('question', 'subjects')); // Kérdés szerkesztése
    }

    public function update(Request $request, $id)
    {
        $request->validate(['question' => 'required|string|max:255']);

        $question = Question::findOrFail($id);
        $question->update($request->only('question', 'subject_id', 'score')); // Kérdés frissítése

        // Válaszok frissítése
        foreach ($request->input('answers') as $answerData) {
            $answer = Answer::findOrFail($answerData['id']);
            $answer->update([
                'answer' => $answerData['answer'],
                'is_correct' => $answerData['is_correct'],
            ]);
        }

        return redirect()->route('indexQuestions')->with('success', 'Question successfully updated.'); // Visszajelzés
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete(); // Kérdés törlése

        return redirect()->route('indexQuestions')->with('success', 'Question successfully deleted.'); // Visszajelzés
    }
}
