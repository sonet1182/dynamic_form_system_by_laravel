@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ isset($form) ? 'Edit Form' : 'Create Form' }}
                        <a href="{{ route('forms.index') }}" class="btn btn-secondary float-end">Back to Forms</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ isset($form) ? route('forms.update', $form->id) : route('forms.store') }}"
                            method="POST">
                            @csrf
                            @isset($form)
                                @method('PUT')
                            @endisset

                            <div class="mb-3">
                                <label for="name" class="form-label">Form Name:</label>
                                <input type="text" id="name" name="name"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                    value="{{ old('name', $form->name ?? '') }}" required>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="country" class="form-label">Country:</label>
                                <select id="country" name="country_id"
                                    class="form-select {{ $errors->has('country_id') ? 'is-invalid' : '' }}">
                                    <option value="">Select a country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"
                                            {{ old('country_id', $form->country_id ?? '') == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('country_id') }}
                                    </div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
