<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClinicController extends Controller
{
    //...

    public function index()
    {
        $clinics = Clinic::all();

        return view('admin.clinics.index', compact('clinics'));
    }

    public function create()
    {
        return view('admin.clinics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'address' => 'required|max:255',
            'location' => 'nullable|max:255',
            'phone_number' => 'required|max:255',
        ]);

        $clinic = new Clinic;
        $clinic->name = $request->name;
        $clinic->email = $request->email;
        $clinic->password = Hash::make($request->password);
        $clinic->address = $request->address;
        $clinic->location = $request->location;
        $clinic->phone_number = $request->phone_number;
        $clinic->save();

        return redirect()->back()->with('success', 'Clinic created successfully.');
    }

    public function show(Clinic $clinic)
    {
        return view('clinics.show', compact('clinic'));
    }

    public function edit(Clinic $clinic)
    {
        return view('clinics.edit', compact('clinic'));
    }

    public function update(Request $request, Clinic $clinic)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'location' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|max:255',
            'complury_details' => 'required',
        ]);

        $clinic->update($request->all());

        return redirect()->route('clinics.index')->with('success', 'Clinic updated successfully.');
    }

    public function destroy(Clinic $clinic)
    {
        $clinic->delete();

        return redirect()->route('clinics.index')->with('success', 'Clinic deleted successfully.');
    }
}
