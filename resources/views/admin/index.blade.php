@extends('layouts.master')

@section('content')
    @include('partials.errors')
    @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.create') }}" method="post">
                <div class="form-group">
                    <label for="title">Task</label>
                    <input type="text" placeholder="Write your task here" class="form-control" id="title" name="title">
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    @foreach($tasks as $task)
    <ul id="myUL">
        <li>
            <div class="task">
                <h6>{{ $task->title }}</h6>
            </div>
            <div class="action">
                <a href="{{ route('admin.edit', ['id' => $task->id]) }}"><i class="fa fa-edit"></i></a>
            </div>
            <div class="action">
                <a href="{{ route('admin.delete', ['id' => $task->id]) }}"><i class="fa fa-trash-alt"></i></a>
            </div>
        </li>
    </ul>
    @endforeach
@endsection
