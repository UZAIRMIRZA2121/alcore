<?php

namespace App\Http\Controllers;

use App\Models\DelegateAnswer;
use App\Models\Priority;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Delegate;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DelegateController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $delegates = Delegate::all();
        return view('admin.delegates.index', compact('delegates'));
    }

    public function create()
    {
        $events = Event::all();
        $questions = Question::all();

        return view('admin.delegates.create', compact('events', 'questions'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:delegates,email|max:255',
            'contact_number' => 'required|string|max:20',
            'personal_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'personal_profile' => 'required|string|max:1000',
            'company_profile' => 'required|string|max:1000',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $requestData = $request->except(['question_ids', '_token']);

        // Handle personal picture upload
        if ($request->hasFile('personal_picture')) {
            $image = $request->file('personal_picture');
            $imageName = time() . '_personal.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/delegates', $imageName);
            $requestData['personal_picture'] = $imageName;
        }

        // Handle company logo upload
        if ($request->hasFile('company_logo')) {
            $image = $request->file('company_logo');
            $imageName = time() . '_company.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/companies', $imageName);
            $requestData['company_logo'] = $imageName;
        }

        // Store the delegate
        $delegate = Delegate::create($requestData);

        // Store the answers
        if ($request->has('question_ids')) {
            foreach ($request->question_ids as $questionId) {
                if ($request->has("question_$questionId")) {
                    $answers = $request->input("question_$questionId"); // Get the array of answers
                    DelegateAnswer::create([
                        'delegate_id' => $delegate->id,
                        'question_id' => $questionId,
                        'answers' => implode(',', $answers), // Store as comma-separated string
                    ]);
                }
            }
        }

        return redirect()->route('delegates.index')
            ->with('success', 'Delegate created successfully.');
    }



    public function show($id)
    {
        $delegate = Delegate::findOrFail($id);
        return view('admin.delegates.show', compact('delegate'));
    }

    public function edit($id)
    {
        $events = Event::all();
        $delegate = Delegate::findOrFail($id);
        $savedAnswers = DelegateAnswer::where('delegate_id', $delegate->id)
            ->pluck('answers', 'question_id'); // Fetch answers with question IDs

        return view('admin.delegates.edit', compact('delegate', 'events', 'savedAnswers'));
    }

    public function update(Request $request, Delegate $delegate)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:delegates,email,' . $delegate->id . '|max:255',
            'contact_number' => 'required|string|max:20',
            'personal_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'personal_profile' => 'required|string|max:1000',
            'company_profile' => 'required|string|max:1000',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $requestData = $request->all();

        // Upload and store the personal picture
        if ($request->hasFile('personal_picture')) {
            // Delete the old personal picture if it exists
            if ($delegate->personal_picture) {
                Storage::delete('public/images/delegates/' . $delegate->personal_picture);
            }

            $image = $request->file('personal_picture');
            $imageName = time() . '_personal.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/delegates', $imageName);
            $requestData['personal_picture'] = $imageName;
        }

        // Upload and store the company logo
        if ($request->hasFile('company_logo')) {
            // Delete the old company logo if it exists
            if ($delegate->company_logo) {
                Storage::delete('public/images/companies/' . $delegate->company_logo);
            }

            $image = $request->file('company_logo');
            $imageName = time() . '_company.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/companies', $imageName);
            $requestData['company_logo'] = $imageName;
        }

        $delegate->update($requestData);
        // Update Delegate Answers
        if ($request->question_ids) {
            // Remove old answers for this delegate
            DelegateAnswer::where('delegate_id', $delegate->id)->delete();

            foreach ($request->question_ids as $questionId) {
                if ($request->has("question_$questionId")) {
                    $answers = $request->input("question_$questionId"); // Get selected answers

                    DelegateAnswer::create([
                        'delegate_id' => $delegate->id,
                        'question_id' => $questionId,
                        'answers' => implode(',', $answers), // Store as comma-separated values
                    ]);
                }
            }
        }
        return redirect()->back()
            ->with('success', 'Delegate updated successfully.');
    }
    public function destroy($id)
    {
        $delegate = Delegate::findOrFail($id);
        $delegate->delete();

        return redirect()->route('delegates.index')
            ->with('success', 'Delegate deleted successfully.');
    }



    public function getQuestionAnswers(Request $request)
    {
        $questions = Question::where('event_id', $request->question_id)->get(); // Fetch all questions for the event

        if ($questions->isNotEmpty()) {
            $data = [];

            foreach ($questions as $question) {
                // Explode the comma-separated answers into an array
                $answersArray = explode(',', $question->ans);

                // Prepare formatted question data
                $data[] = [
                    'question_id' => $question->id,
                    'question' => $question->qus,
                    'answers' => array_map('trim', $answersArray), // Trim spaces from answers
                ];
            }
            Log::info($data);
            return response()->json([
                'success' => true,
                'questions' => $data,
            ]);
        }

        return response()->json(['success' => false]);
    }


}
