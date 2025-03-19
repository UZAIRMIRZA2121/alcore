<?php

namespace App\Http\Controllers;

use App\Models\Delegate;
use App\Models\Priority;
use App\Models\Sponsor;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::all();
        return view('admin.sponsors.index', compact('sponsors'));
    }

    public function create()
    {
        $events = Event::all();
        return view('admin.sponsors.create', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:sponsors',
            'email' => 'required|email|unique:sponsors',
            'password' => 'required|string|min:8',
            'status' => 'required|string|in:active,inactive',
            'phone' => 'required|string|max:15',
            'event_id' => 'required|integer|exists:events,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'details' => 'required|string',
            'company_details' => 'required|string',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        // Handle file uploads
        if ($request->hasFile('image')) {
            $data['image'] = $this->storeFile($request->file('image'), 'images');

        }

        if ($request->hasFile('company_image')) {
            $data['company_image'] = $this->storeFile($request->file('company_image'), 'company_images');
        }

        Sponsor::create($data);

        return redirect()->route('sponsors.index')
            ->with('success', 'Sponsor created successfully.');
    }

    public function show(Sponsor $sponsor)
    {
        return view('admin.sponsors.show', compact('sponsor'));
    }

    public function edit(Sponsor $sponsor)
    {
        $events = Event::all();
        return view('admin.sponsors.edit', compact('sponsor', 'events'));
    }

    public function update(Request $request, Sponsor $sponsor)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:sponsors,username,' . $sponsor->id,
            'email' => 'required|email|unique:sponsors,email,' . $sponsor->id,
            'password' => 'nullable|string|min:8',
            'status' => 'required|string|in:active,inactive',
            'phone' => 'required|string|max:15',
            'event_id' => 'required|integer|exists:events,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'details' => 'required|string',
            'company_details' => 'required|string',
        ]);

        $data = $request->except(['password', 'image', 'company_image']);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($sponsor->image) {
                Storage::disk('public')->delete($sponsor->image);
            }
            $data['image'] = $this->storeFile($request->file('image'), 'images');
        }

        // Handle company image upload
        if ($request->hasFile('company_image')) {
            if ($sponsor->company_image) {
                Storage::disk('public')->delete($sponsor->company_image);
            }
            $data['company_image'] = $this->storeFile($request->file('company_image'), 'company_images');
        }

        $sponsor->update($data);

        return redirect()->back()
            ->with('success', 'Sponsor updated successfully.');
    }
    public function self_update(Request $request)
    {
        $user = Auth::guard('sponsor')->user();

        $request->validate([
            'fullName' => 'required|string|max:255',
            'about' => 'nullable|string',
            'company' => 'nullable|string|max:255',
            'job' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:sponsors,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle profile image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image) {
                Storage::delete('public/' . $user->image);
            }
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $user->image = $imagePath;
        }

        // Update user details
        $user->username = $request->fullName;
        $user->details = $request->about;
        $user->company_name = $request->company;
        $user->job = $request->job;
        $user->phone = $request->phone;
        $user->email = $request->email;

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }



    public function destroy(Sponsor $sponsor)
    {
        $sponsor->delete();

        return redirect()->route('sponsors.index')
            ->with('success', 'Sponsor deleted successfully.');
    }




    /**
     * Store the uploaded file and return its path.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @return string
     */
    private function storeFile($file, $directory)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs($directory, $fileName, 'public');
    }



    // sponsor controller
    public function dashboard()
    {
        $delegates = Delegate::where('event_id', Auth::guard('sponsor')->user()->event_id)
            ->with('priority') // Load priority relationship
            ->get();

        return view('sponsors.dashboard', compact('delegates'));
    }

    public function profile()
    {
        return view('profile.profile');
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Update user's full name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Upload profile image if provided
        if ($request->hasFile('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/images/profile-images', $fileName); // Change the storage path as needed
            $user->profile_photo_path = $fileName;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'newpassword' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password matches the user's password
        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()->withErrors(['password' => 'The current password is incorrect']);
        }

        // Update the user's password
        $user->password = Hash::make($request->input('newpassword'));
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully');
    }








    public function meeting($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $priorities = Priority::where('sponsor_id', $sponsor->id)->get();

        // Fetch related data if needed
        return view('admin.sponsors.meeting', compact('sponsor', 'priorities'));
    }
    public function updatePriorities(Request $request)
    {
        $delegates = $request->input('delegates');

        if (!$delegates) {
            return redirect()->back()->with('error', 'No data received!');
        }

        $sponsorId = Auth::guard('sponsor')->id();
        $eventId = Auth::guard('sponsor')->user()->event_id;

        foreach ($delegates as $delegateData) {
            $priority = Priority::firstOrNew([
                'event_id' => $eventId,
                'sponsor_id' => $sponsorId,
                'delegates_id' => $delegateData['id'],
            ]);

            $priority->priority = $delegateData['priority'];
            $priority->status = 'active';
            $priority->save();
        }
      
        return redirect()->back()->with('success', 'Priorities updated successfully!');
    }




    public function priorities_update(Request $request)
    {
        $priorityIds = $request->input('priority_ids', []);
        $startTimes = $request->input('start_time', []);
        $endTimes = $request->input('end_time', []);

        foreach ($priorityIds as $id) {
            $priority = Priority::find($id);
            if ($priority) {
                $priority->start_time = $request->start_time[$id] ?? null;
                $priority->end_time = $request->end_time[$id] ?? null;
                $priority->save();
            }
        }

        return redirect()->back()->with('success', 'Priorities updated successfully!');
    }

    public function delegate_show($id)
    {
        $delegate = Delegate::findOrFail($id);
        return view('sponsors.delegate-details', compact('delegate'));
    }

    public function my_meeting()
    {
        $sponsor = Auth::guard('sponsor')->user();
        $priorities = Priority::where('sponsor_id', $sponsor->id)
        ->with(['sponsor', 'event', 'delegate'])
        ->get();

       
        return view('sponsors.meetings', compact('priorities'));
    }

}
