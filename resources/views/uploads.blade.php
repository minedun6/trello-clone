@extends('app')

@section('content')
    <div id="app">
        <navigation></navigation>
        <uploader endpoint="{{ route('uploads') }}"></uploader>
    </div>
@stop
