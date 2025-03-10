@extends('layouts.main')

@section('content')
    <div class="row py-5">
        <div class="jumbotron bg-light col-8 offset-2 p-4">
            <h2>Hello {{ $name }}!</h2>
            <p class="lead">Welcome to the site.</p>
            <hr class="my-4">
            <p>{{ $num ?? 42 }} is the meaning of life</p>
        </div>
    </div>
@endsection