<?php

// app/Http/Controllers/FormController.php
namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::with('country')->get();
        return view('forms.index', compact('forms'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('forms.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $form = Form::create($request->all());

        return redirect()->route('forms.edit', $form->id);
    }

    public function edit(Form $form)
    {
        $countries = Country::all();
        $form->load('fields');
        return view('forms.edit', compact('form', 'countries'));
    }

    public function update(Request $request, Form $form)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $form->update($request->all());

        return redirect()->route('forms.index');
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('forms.index');
    }
}
