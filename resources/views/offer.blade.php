@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-2">
        <div>
            <strong>Keyword : <i>*{{request()->keyword}}*</i></strong>
        </div>
        <div>
            <form action="/offers" method="GET" id="formSubmit">
                <input type="hidden" name="keyword" value="{{request()->keyword}}">
                <select name="filter_1" id="" onchange="document.getElementById('formSubmit').submit()">
                    <option value="newest" {{request()->filter_1 == 'newest' ? 'selected':''}}>Newest - Oldest</option>
                    <option value="oldest" {{request()->filter_1 == 'oldest' ? 'selected':''}}>Oldest - Newest</option>
                </select>
            </form>
        </div>
    </div>
    @forelse($offers as $offer)
    <div class="card mt-2">
            <div class="card-header d-flex justify-content-between" style="align-items: center">
                <div>
                    Title: {{$offer->title}}
                </div>
                <small>
                   {{$offer->created_at->format('M d,y H:i a')}}
                </small>
            </div>
            <div class="card-body" x-data="{showMore:false}">
                <div>
                    Employer: {{$offer->user->name}}
                </div>
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
                    Description:
                    <div x-show="!showMore">
                        {{\Str::limit($offer->description, 300)}}
                        <small><a href="#" x-on:click.prevent="showMore=true">show more</a></small>
                    </div>
                    <div x-show="showMore">
                        {{$offer->description}}
                        <small><a href="#" x-on:click.prevent="showMore=false">show less</a></small>
                    </div>
                </div>
                @if (!is_null($offer->attachment))
                    Attachment: <a href="/storage/{{$offer->attachment_link}}" target="_blank">View Attachment</a>
                @endif
            </div>
            <div class="card-footer d-flex justify-content-end">
                @if (auth()->user()->resume && !auth()->user()->isApplied($offer->id))
                    <form action="/apply" method="POST">
                        @csrf
                        <input type="hidden" name="offer_id" value="{{$offer->id}}">
                        <button class="btn btn-success btn-sm">Apply Now</button>
                    </form>
                @elseif(auth()->user()->isApplied($offer->id))
                    You've already applied to this Offer.
                @else
                <form action="#" method="POST">
                    @csrf
                    <button class="btn btn-success btn-sm" disabled>Apply Now</button>
                    <div>
                        <small class="text-sm text-danger">You should upload your resume first.</small>
                    </div>
                </form>
                @endif

            </div>
        </div>

    @empty
    <div class="card card-body text-center">
        No Result Found !
    </div>
    @endforelse
    <div class="mt-2">
        {{$offers->links()}}
    </div>
@endsection
