@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Forms List
                        <a href="{{ route('forms.create') }}" class="btn btn-primary float-end">Create New Form</a>
                    </div>

                    <div class="card-body">
                        @if ($forms->isEmpty())
                            <p>No forms available.</p>
                        @else
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Country</th>
                                        <th>Submissions</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($forms as $form)
                                        <tr>
                                            <td>{{ $form->name }}</td>
                                            <td>{{ $form->country->name ?? '' }}</td>
                                            <td>
                                                <a href="{{ route('submissions.index', $form->id) }}"
                                                    class="btn btn-info text-light btn-sm">View Submissions</a>
                                                <a href="{{ route('submissions.create', $form->id) }}"
                                                    class="btn btn-primary btn-sm">Submit Form</a>

                                            </td>

                                            <td>
                                                <a href="{{ route('forms.edit', $form->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('forms.destroy', $form->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this form?');">Delete</button>
                                                </form>
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
