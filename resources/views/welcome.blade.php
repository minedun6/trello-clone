@extends('app')

@section('content')
    <div class="todo-ui" id="app">
        <todo-app stories-endpoint="{{ route('stories.index') }}"></todo-app>
    </div>
@stop