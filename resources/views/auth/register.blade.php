@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-warning">{{ __('Register') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                <div class="col-md-6">
                    {{-- <input id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="name" value="{{ old('type') }}" required autocomplete="name" autofocus> --}}

                    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" name="name" value="{{ old('type') }}">
                        <option value="{{\App\Models\User::TYPE_JOB_SEEKER}}">OJT Applicant</option>
                        <option value="{{\App\Models\User::TYPE_EMPLOYER}}">OJT Employer</option>
                    </select>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                <div class="col-md-6">
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="middle_name" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

                <div class="col-md-6">
                    <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" required autocomplete="middle_name" autofocus>

                    @error('middle_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                <div class="col-md-6">
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                <div class="col-md-6">
                    {{-- <input id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="name" value="{{ old('type') }}" required autocomplete="name" autofocus> --}}

                    <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>

                    @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="school" class="col-md-4 col-form-label text-md-right">{{ __('School') }}</label>

                <div class="col-md-6">
                    <input id="school" type="text" class="form-control @error('school') is-invalid @enderror" name="school" value="{{ old('school') }}" required autocomplete="school" autofocus>

                    @error('school')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="course" class="col-md-4 col-form-label text-md-right">{{ __('Course') }}</label>

                <div class="col-md-6">
                    <input id="course" type="text" class="form-control @error('course') is-invalid @enderror" name="course" value="{{ old('course') }}" required autocomplete="school" autofocus>

                    @error('course')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
