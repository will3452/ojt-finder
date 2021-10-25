@extends('layouts.app')

@section('content')
    <div class="card" x-data="{isEdit:false}">
        <div class="card-header d-flex justify-content-between">
            Profile
            <button class="btn btn-sm btn-success" x-show="!isEdit" x-on:click="isEdit=true">
                Edit
            </button>
            <button class="btn btn-sm btn-success" x-show="isEdit" x-on:click="isEdit=false">
                Cancel
            </button>
        </div>
        <div class="card-body">
            <div >
                <template x-if="!isEdit">
                    <div>
                        <div class="my-2">
                            <img
                            src="{{auth()->user()->profile ? '/storage/'.auth()->user()->profile->profile_picture : '/no-image.jpg'}}"
                             style="width:100px; height:100px; object-fit:cover;"
                             alt=""/>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    Type
                                </td>
                                <td>
                                    {{auth()->user()->type}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Name
                                </td>
                                <td>
                                    {{auth()->user()->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Email
                                </td>
                                <td>
                                    {{auth()->user()->email}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Inline Address
                                </td>
                                <td>
                                    {{auth()->user()->profile ? auth()->user()->profile->inline_address : '---'}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    City
                                </td>
                                <td>
                                    {{auth()->user()->profile ? auth()->user()->profile->city : '---'}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    About
                                </td>
                                <td>
                                    {{auth()->user()->profile ? auth()->user()->profile->about : '---'}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </template>
                <template x-if="isEdit">
                    <form action="/profile/{{auth()->id()}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div>
                            <img
                            src="{{auth()->user()->profile ? '/storage/'.auth()->user()->profile->profile_picture : '/no-image.jpg'}}"
                             style="width:100px; height:100px; object-fit:cover;"
                             alt=""/>
                            <input type="file" name="picture" accept="image/*" required>
                            @error('picture')
                                {{$message}}
                            @enderror
                        </div>
                        <table class="table table-bordered mt-2">
                            <tr>
                                <td>
                                    Name
                                </td>
                                <td>
                                    <input type="text" name="name" required value="{{auth()->user()->name}}">
                                    @error('name')
                                        {{$message}}
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Password
                                </td>
                                <td>
                                    <input type="password" name="password" required value="">
                                    @error('password')
                                        {{$message}}
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Inline Address
                                </td>
                                <td>
                                    <input type="text" name="inline_address" required value="{{auth()->user()->profile ? auth()->user()->profile->address: ''}}">
                                    @error('inline_address')
                                        {{$message}}
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    City
                                </td>
                                <td x-data="{cities:[]}" x-init="
                                    fetch('https://psgc.gitlab.io/api/cities/')
                                        .then(res=>res.json())
                                        .then(res=>{
                                            cities = res;
                                        })
                                ">
                                    <select name="city" required id="">
                                        <template x-for="city in cities">
                                            <option x-bind:value="city.name" x-text="city.name"></option>
                                        </template>
                                    </select>
                                    @error('city')
                                        {{$message}}
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    About
                                </td>
                                <td>
                                    <textarea name="about"></textarea>
                                    @error('about')
                                        {{$message}}
                                    @enderror
                                </td>
                            </tr>
                        </table>
                        <div class="text-right">
                            <button class="btn btn-sm btn-primary">update profile</button>
                        </div>
                    </form>
                </template>


            </div>
        </div>
    </div>
@endsection
