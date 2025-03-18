<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Event;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // Show all questions
    public function index()
    {
        $questions = Question::latest()->paginate(10);
        return view('admin.questions.index', compact('questions'));
    }

    // Show create form
    public function create()
    {
        $events = Event::all(); // Fetch events for dropdown
        return view('admin.questions.create', compact('events'));
    }

    // Store new question
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'qus' => 'required|string|max:255',
            'ans' => 'required|array',
            'ans.*' => 'string', // Each answer should be a string
        ]);

        Question::create([
            'event_id' => $request->event_id,
            'qus' => $request->qus,
           'ans' => implode(',', $request->ans),

        ]);

        return redirect()->route('questions.index')->with('success', 'Question added successfully!');
    }

    // Show single question
    public function show(Question $question)
    {
        return view('admin.questions.show', compact('question'));
    }

    // Show edit form
    public function edit(Question $question)
    {
        $events = Event::all();
        return view('admin.questions.edit', compact('question', 'events'));
    }

    // Update question
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'qus' => 'required|string|max:255',
            'ans' => 'required|array',
            'ans.*' => 'string',
        ]);

        $question->update([
            'event_id' => $request->event_id,
            'qus' => $request->qus,
            'ans' => implode(',', $request->ans),
        ]);

        return redirect()->route('questions.index')->with('success', 'Question updated successfully!');
    }

    // Delete question
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully!');
    }
}
