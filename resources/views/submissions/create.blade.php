@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Submit {{ $form->name }}</div>

                    <div class="card-body">
                        @include('layouts.session')

                        <form action="{{ route('submissions.store', $form->id) }}" method="POST">
                            @csrf

                            @foreach ($form->fields as $field)
                                <div class="mb-3">
                                    <label for="{{ $field->name }}" class="form-label">
                                        {{ $field->label }}
                                        @if ($field->required)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>

                                    @if ($field->type == 'text')
                                        <input type="text" id="{{ $field->name }}" name="{{ $field->name }}"
                                            class="form-control {{ $errors->has($field->name) ? 'is-invalid' : '' }}"
                                            value="{{ old($field->name) }}" {{ $field->required ? 'required' : '' }}>
                                    @elseif($field->type == 'number')
                                        <input type="number" id="{{ $field->name }}" name="{{ $field->name }}"
                                            class="form-control {{ $errors->has($field->name) ? 'is-invalid' : '' }}"
                                            value="{{ old($field->name) }}" {{ $field->required ? 'required' : '' }}>
                                    @elseif($field->type == 'date')
                                        <input type="date" id="{{ $field->name }}" name="{{ $field->name }}"
                                            class="form-control {{ $errors->has($field->name) ? 'is-invalid' : '' }}"
                                            value="{{ old($field->name) }}" {{ $field->required ? 'required' : '' }}>
                                    @elseif($field->type == 'dropdown')
                                        <select id="{{ $field->name }}" name="{{ $field->name }}"
                                            class="form-select {{ $errors->has($field->name) ? 'is-invalid' : '' }}"
                                            {{ $field->required ? 'required' : '' }}>
                                            @foreach ($field->options as $option)
                                                <option value="{{ $option }}"
                                                    {{ old($field->name) == $option ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @elseif($field->type == 'email')
                                        <input type="email" id="{{ $field->name }}" name="{{ $field->name }}"
                                            class="form-control {{ $errors->has($field->name) ? 'is-invalid' : '' }}"
                                            value="{{ old($field->name) }}" {{ $field->required ? 'required' : '' }}>
                                    @elseif($field->type == 'password')
                                        <input type="password" id="{{ $field->name }}" name="{{ $field->name }}"
                                            class="form-control {{ $errors->has($field->name) ? 'is-invalid' : '' }}"
                                            value="{{ old($field->name) }}" {{ $field->required ? 'required' : '' }}>
                                    @elseif($field->type == 'checkbox')
                                        @foreach ($field->options as $option)
                                            <div class="form-check">
                                                <input type="checkbox" id="{{ $field->name . '_' . $option }}"
                                                    name="{{ $field->name }}[]"
                                                    class="form-check-input {{ $errors->has($field->name) ? 'is-invalid' : '' }}"
                                                    value="{{ $option }}"
                                                    {{ in_array($option, old($field->name, [])) ? 'checked' : '' }}
                                                    {{ $field->required ? 'required' : '' }}>
                                                <label class="form-check-label" for="{{ $field->name . '_' . $option }}">
                                                    {{ $option }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @elseif($field->type == 'radio')
                                        @foreach ($field->options as $option)
                                            <div class="form-check">
                                                <input type="radio" id="{{ $field->name . '_' . $option }}"
                                                    name="{{ $field->name }}"
                                                    class="form-check-input {{ $errors->has($field->name) ? 'is-invalid' : '' }}"
                                                    value="{{ $option }}"
                                                    {{ old($field->name) == $option ? 'checked' : '' }}
                                                    {{ $field->required ? 'required' : '' }}>
                                                <label class="form-check-label" for="{{ $field->name . '_' . $option }}">
                                                    {{ $option }}
                                                    @if ($field->required)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif

                                    @if ($errors->has($field->name))
                                        <div class="invalid-feedback">
                                            {{ $errors->first($field->name) }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>






                </div>
            </div>
        </div>
    </div>
@endsection
