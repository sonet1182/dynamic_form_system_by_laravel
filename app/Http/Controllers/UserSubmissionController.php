<?php

// app/Http/Controllers/UserSubmissionController.php
namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\UserSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSubmissionController extends Controller
{
    public function index(Form $form)
    {
        $submissions = $form->submissions()->with('values')->get(); // Retrieve all submissions for the given form
        return view('submissions.index', compact('form', 'submissions'));
    }
    public function create(Form $form)
    {
        $form->load('fields');
        return view('submissions.create', compact('form'));
    }

    public function store(Request $request, Form $form)
    {
        // Validate the incoming request data
        $validatedData = $request->validate(
            $form->fields->mapWithKeys(function ($field) {
                // Apply required or nullable validation rules
                return [
                    $field->name => $field->required ? 'required' : 'nullable'
                ];
            })->toArray()
        );

        // Create a new submission record
        $submission = UserSubmission::create([
            'form_id' => $form->id,
            'user_id' => Auth::id(),
        ]);

        foreach ($form->fields as $field) {
            // Get the input value
            $value = $request->input($field->name);

            // If the field is a checkbox and the value is an array, convert it to JSON
            if ($field->type === 'checkbox' && is_array($value)) {
                $value = json_encode($value);
            }

            // Create a new submission value record
            $submission->values()->create([
                'form_field_id' => $field->id,
                'value' => $value,
            ]);
        }

        // Redirect back with a success message
        return back()->with('status', 'Form submitted successfully!');
    }


    public function show($id)
    {
        $submission = UserSubmission::with('values.formField')->findOrFail($id);
        return view('submissions.show', compact('submission'));
    }


    public function edit(UserSubmission $submission)
    {
        $submission->load('form.fields', 'values');
        return view('submissions.edit', compact('submission'));
    }

    public function update(Request $request, UserSubmission $submission)
    {
        foreach ($submission->form->fields as $field) {
            $submissionValue = $submission->values()->where('form_field_id', $field->id)->first();
            if ($submissionValue) {
                $submissionValue->update(['value' => $request->input($field->name)]);
            } else {
                $submission->values()->create([
                    'form_field_id' => $field->id,
                    'value' => $request->input($field->name),
                ]);
            }
        }

        return redirect()->route('home')->with('status', 'Form updated successfully!');
    }
}
