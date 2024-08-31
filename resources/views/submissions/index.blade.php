@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Submissions for "{{ $form->title }}"
                    <a href="{{ route('forms.index') }}" class="btn btn-secondary float-end">Back to Forms</a>
                </div>

                <div class="card-body">
                    @if($submissions->isEmpty())
                        <p>No submissions available for this form.</p>
                    @else
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Submission ID</th>
                                    <th>User</th>
                                    <th>Submission Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($submissions as $submission)
                                    <tr>
                                        <td>{{ $submission->id }}</td>
                                        <td>{{ $submission->user->name }}</td>
                                        <td>{{ $submission->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            <a href="{{ route('submissions.show', $submission->id) }}" class="btn btn-info btn-sm">View Details</a>
                                            <!-- You can add more actions here if needed -->
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
