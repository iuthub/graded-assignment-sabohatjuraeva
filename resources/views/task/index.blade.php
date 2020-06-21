@extends('layouts.master')

@section('content')
        <div id="myDIV" class="header">
            <h2>To Do List</h2>
        </div>
    @foreach($users as $user)
    <ul id="myUL">
        <li>
            <div class="task">
                <h6>{{ $user->name }} - task list!</h6>
            </div>
        </li>
    </ul>
    @endforeach
@endsection
