<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delegate;
use App\Models\Event;
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
        return view('admin.delegates.create', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id', // Validation for event ID
            'name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:delegates,email|max:255',
            'contact_number' => 'required|string|max:20',
            'personal_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for image upload
            'personal_profile' => 'required|string|max:1000',
            'company_profile' => 'required|string|max:1000',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validation for company logo upload
        ]);

        $requestData = $request->all();

        // Upload and store the personal picture
        if ($request->hasFile('personal_picture')) {
            $image = $request->file('personal_picture');
            $imageName = time() . '_personal.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/delegates', $imageName);
            $requestData['personal_picture'] = $imageName;
        }

        // Upload and store the company logo
        if ($request->hasFile('company_logo')) {
            $image = $request->file('company_logo');
            $imageName = time() . '_company.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/companies', $imageName);
            $requestData['company_logo'] = $imageName;
        }

        Delegate::create($requestData);

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
        return view('admin.delegates.edit', compact('delegate', 'events'));
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
}
