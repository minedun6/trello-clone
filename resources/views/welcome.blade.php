@extends('app')

@section('content')
    <div id="app">
        <navigation></navigation>
        <project-menu></project-menu>
        <kanban-board></kanban-board>

        {{-- <login></login> --}}

        @include('modals.all')

    </div>
@stop
