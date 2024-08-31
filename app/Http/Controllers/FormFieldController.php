<?php

// app/Http/Controllers/FormFieldController.php
namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;

class FormFieldController extends Controller
{
    public function store(Request $request, Form $form)
    {
        // return $request;
        $request->validate([
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:form_fields,name,NULL,id,form_id,' . $form->id,
            'type' => 'required|string|in:text,number,date,dropdown,email,password,radio,checkbox',
            'required_field' => 'nullable|boolean',
            'category' => 'required|string|in:general,identity,bank',
            'options' => 'nullable|string',
        ]);

        // Retrieve and process options
        $options = $request->input('options', '');
        if (is_string($options)) {
            $options = array_map('trim', explode(',', $options));
        } else {
            $options = [];
        }

        // Prepare data for storage
        $fieldData = $request->except('_token');
        $fieldData['required'] = $request->boolean('required_field');
        $fieldData['options'] = $options;

        $form->fields()->create($fieldData);

        return redirect()->route('forms.edit', $form->id)->with('success', 'Field added successfully!');
    }



    public function update(Request $request, Form $form, FormField $field)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:form_fields,name,' . $field->id . ',id,form_id,' . $form->id,
            'type' => 'required|string|in:text,number,date,dropdown,email,password',
            'required' => 'boolean',
            'category' => 'required|string|in:general,identity,bank',
            'options' => 'nullable|array',
        ]);

        $fieldData = $request->all();
        $fieldData['options'] = $request->options ?? [];

        $field->update($fieldData);

        return redirect()->route('forms.edit', $form->id);
    }

    public function destroy(Form $form, FormField $field)
    {
        $field->delete();
        return redirect()->route('forms.edit', $form->id);
    }
}
