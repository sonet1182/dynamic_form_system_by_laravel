@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Submission Details
                    <a href="{{ route('submissions.index', $submission->form_id) }}" class="btn btn-secondary float-end">Back to Submissions</a>
                </div>

                <div class="card-body">
                    <h5>Submitted by: {{ $submission->user->name }}</h5>
                    <p><strong>Submission Date:</strong> {{ $submission->created_at->format('Y-m-d H:i:s') }}</p>

                    @if ($submission->values->isEmpty())
                        <p>No details available for this submission.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($submission->values as $value)
                                    <tr>
                                        <td>{{ $value->formField->label }}</td>
                                        <td>
                                            @if ($value->formField->type === 'checkbox')
                                                @php
                                                    // Decode JSON data if it's a checkbox
                                                    $options = json_decode($value->value, true);
                                                @endphp
                                                @if (is_array($options))
                                                    @foreach ($options as $option)
                                                        <span class="badge bg-primary">{{ $option }}</span>
                                                    @endforeach
                                                @else
                                                    {{ $value->value }}
                                                @endif
                                            @else
                                                {{ $value->value }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
