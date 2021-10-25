@extends('layouts.app')

@section('content')
    <div>
        <div class="card mt-2">
            <div class="card-header d-flex justify-content-between" style="align-items: center">
                <div>
                    Title: {{$offer->title}}
                </div>
                <small>
                    Created At: {{$offer->created_at->format('m/d/y')}}
                </small>
            </div>
            <div class="card-body">

                <div>
                    Location: {{$offer->location}}
                </div>
                <div>
                    City: {{$offer->city}}
                </div>
                <div>
                    Setup: {{$offer->setup}}
                </div>
                <div>
                    Description: {{$offer->description}}
                </div>
                @if (!is_null($offer->attachment))
                    Attachment: <a href="/storage/{{$offer->attachment_link}}" target="_blank">View Attachment</a>
                @endif
            </div>
        </div>
        <h3 class="text-center my-3">Pending Applications</h3>
        @forelse ($offer->applications()->where('status', \App\Models\Application::STATUS_PENDING)->get() as $application)

        <div class="card mt-2">
                <div class="card-header d-flex justify-content-between" style="align-items: center">
                    <div>
                        Name: {{$application->user->name}}
                    </div>
                    <small>
                      Submitted Date: {{$application->created_at->format('m/d/y')}}
                    </small>
                </div>
                <div class="card-body">
                    <a target="_blank" href="/storage/{{$application->user->resume->file_link}}" class="btn btn-sm btn-primary">View Resume</a>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <form action="/applications/{{$application->id}}" method="POST">
                        <input type="hidden" name="status" value="{{\App\Models\Application::STATUS_IGNORE}}">
                        @csrf
                        <button class="btn btn-danger btn-sm">Disapprove</button>
                    </form>
                    <form action="/applications/{{$application->id}}" method="POST">
                        <input type="hidden" name="status" value="{{\App\Models\Application::STATUS_APPROVED}}">
                        @csrf
                        <button class="btn btn-success btn-sm">Approve</button>
                    </form>
                </div>
            </div>
        @empty
        <div class="alert alert-warning text-center">
            No Application found.
        </div>
        @endforelse
    </div>
@endsection
