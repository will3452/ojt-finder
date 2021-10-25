@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Dashboard') }}</div>

    <div class="card-body">
        <div class="row">
            @employer
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-header " style="font-weight: bold">
                        YOUR OFFER
                    </div>
                    <div class="card-body">
                        <h2 style="font-weight: bold">
                            {{auth()->user()->offers()->count()}}
                        </h2>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-header " style="font-weight: bold">
                        NO. OF OJT SEEKERS
                    </div>
                    <div class="card-body">
                        <h2 style="font-weight: bold">
                            {{\App\Models\JobSeeker::count()}}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-header " style="font-weight: bold">
                        NO. OF EMPLOYERS
                    </div>
                    <div class="card-body">
                        <h2 style="font-weight: bold">
                            {{\App\Models\Employer::count()}}
                        </h2>
                    </div>
                </div>
            </div>
            @jobseeker
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-header " style="font-weight: bold">
                        APPLICATIONS
                    </div>
                    <div class="card-body">
                        <h2 style="font-weight: bold">
                            {{auth()->user()->applications()->count()}}
                        </h2>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @jobseeker
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Upload Resume
                    </div>
                    <div class="card-body">
                        <ul class="list-group mb-2 ">
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    {{auth()->user()->resume ? auth()->user()->resume->created_at->format('m-y-d h:m a') : 'no resume uploaded'}}
                                </div>
                                @if (auth()->user()->resume)
                                <div>
                                    <form action="/delete-resume/{{auth()->user()->resume->id}}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-danger"><i class="material-icons">delete</i></button>
                                    </form>
                                </div>
                                @endif
                            </li>
                        </ul>
                        <form action="/upload-resume" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <input type="file" name="file" required accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
                                text/plain, application/pdf, image/*"/>
                            </div>
                            <small class="bg-warning px-2">
                                image, txt, pdf, docx only.
                            </small>
                            <div class="mt-2">
                                <button class="btn btn-primary btn-block">UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
