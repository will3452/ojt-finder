@extends('layouts.app')

@section('content')


    <div class="card">
        <div class="card-header">
            My Application statuses
        </div>
        <div class="card-body">
            <table id="example" class="table">
                <thead>
                    <tr>
                        <th>
                            Date
                        </th>
                        <th>
                            Employer
                        </th>
                        <th>
                            Title
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <td>
                                {{$application->created_at->format('m-d-Y H:i A')}}
                            </td>
                            <td>
                                {{$application->offer->user->name}}
                            </td>
                            <td>
                                {{$application->offer->title}}
                            </td>
                            <td>
                                {{$application->status}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
