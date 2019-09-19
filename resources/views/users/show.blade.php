@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ Auth::user()->name }}
            {{ Auth::user()->surname }}
            {{ Auth::user()->username }}
            {{ Auth::user()->relationship_status }}
            {{ Auth::user()->address }}
            {{ Auth::user()->zipcode }}

            <a href="{{ route('users.edit', Auth::user()) }}">Edit</a>
        </div>
    </div>
</div>
@endsection
