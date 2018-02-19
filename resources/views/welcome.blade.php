@extends('app')

@section('content')
    <div id="app">
        <navigation></navigation>
        <project-menu></project-menu>
        <kanban-board></kanban-board>

        @include('modals.all')

    </div>
@stop
