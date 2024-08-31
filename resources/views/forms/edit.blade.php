@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Fields
                        <a href="{{ route('forms.index') }}" class="btn btn-secondary float-end">Back to Forms</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('fields.store', $form->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="label" class="form-label">Label:</label>
                                <input type="text" id="label" name="label" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">Type:</label>
                                <select id="type" name="type" class="form-select" required onchange="toggleOptionsField()">
                                    <option value="text">Text</option>
                                    <option value="number">Number</option>
                                    <option value="date">Date</option>
                                    <option value="dropdown">Dropdown</option>
                                    <option value="radio">Radio</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="email">Email</option>
                                    <option value="password">Password</option>
                                </select>
                            </div>

                            <div class="mb-3" id="options-container" style="display: none;">
                                <label for="options" class="form-label">Options (comma-separated):</label>
                                <input type="text" id="options" name="options" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Category:</label>
                                <select id="category" name="category" class="form-select" required>
                                    <option value="general">General</option>
                                    <option value="identity">Identity</option>
                                    <option value="bank">Bank</option>
                                </select>
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="required_field" name="required_field" value="1">
                                <label for="required" class="form-check-label">Required</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Field</button>
                        </form>

                        
                    </div>

                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        Existing Fields
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($form->fields as $field)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $field->label }} ({{ $field->type }})
                
                                    @if (in_array($field->type, ['dropdown', 'checkbox', 'radio']) && $field->options)
                                        <div class="ms-3">
                                            @foreach ($field->options as $option)
                                                <span class="badge bg-primary">{{ $option }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                
                                    <form action="{{ route('fields.destroy', [$form->id, $field->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script>
        function toggleOptionsField() {
            const type = document.getElementById('type').value;
            const optionsContainer = document.getElementById('options-container');
            if (type === 'dropdown' || type === 'radio' || type === 'checkbox') {
                optionsContainer.style.display = 'block';
            } else {
                optionsContainer.style.display = 'none';
            }
        }
    </script>
@endsection
