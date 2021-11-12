@extends('layouts.app')

@section('content')
    <div  x-data="{isCreate:false}">
        <template x-if="!isCreate">
            <div>
                <div class=" d-flex justify-content-between">
                    <b>List of your Offers ({{count(auth()->user()->offers)}})</b>
                    <button class="btn btn-primary btn-sm" x-on:click="isCreate=true">Create new Offer</button>
                </div>
                <div class="card-body">
                    @forelse (auth()->user()->offers as $offer)
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
                            <div class="card-footer d-flex justify-content-between">
                                <form action="/offer/{{$offer->id}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a class="btn btn-primary btn-sm" href="/applications/{{$offer->id}}">View Applications ({{$offer->applications()->where('status', \App\Models\Application::STATUS_PENDING)->count()}})</a>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning">
                            No Offer Found!
                        </div>
                    @endforelse
                </div>
            </div>
        </template>
        <template x-if="isCreate">
            <div>
                <div class="d-flex justify-content-between">
                    <b>Create New Offer</b>
                    <button class="btn btn-primary btn-sm" x-on:click="isCreate=false">Cancel</button>
                </div>
                <div class="card-body">
                    <form action="/offer" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Location</label>
                            <input type="text" value="{{auth()->user()->address}}" name="location" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <div x-data="{cities:[]}" x-init="
                                fetch('https://psgc.gitlab.io/api/cities/')
                                    .then(res=>res.json())
                                    .then(res=>{
                                        cities = res;
                                    })
                            ">
                                <select name="city" required id="" class="custom-select">
                                    <template x-for="city in cities">
                                        <option x-bind:value="city.name" x-text="city.name"></option>
                                    </template>
                                </select>
                                @error('city')
                                    {{$message}}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="setup">Setup</label>
                            <div>
                                <label for="" class="mr-4">
                                    {{\App\Models\Offer::SETUP_WFH}}
                                    <input type="radio" name="setup" value="{{\App\Models\Offer::SETUP_WFH}}" required>
                                </label>
                                <label for="" class="mr-4">
                                    {{\App\Models\Offer::SETUP_ON_SITE}}
                                    <input type="radio" name="setup" value="{{\App\Models\Offer::SETUP_ON_SITE}}" required>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Attachment (optional)</label>
                            <input type="file" name="attachment" class="d-block">
                            <small>maximum of 2mb only</small>
                        </div>

                        <div class="text-right">
                            <button class="btn btn-primary btn-sm">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </template>
    </div>
@endsection
