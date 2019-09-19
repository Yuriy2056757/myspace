@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                {{ Auth::user()->name }}
            </div>

            <div>
                {{ Auth::user()->surname }}
            </div>

            <div>
                {{ Auth::user()->username }}
            </div>

            <div>
                {{ Auth::user()->email }}
            </div>

            <div>
                {{ Auth::user()->address }}
            </div>

            <div>
                {{ Auth::user()->zipcode }}
            </div>

            <div>
                {{ Auth::user()->relationship_status }}
            </div>

            <div>
                <a class='btn btn-primary' href="{{ route('users.edit', Auth::user()) }}">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
@endsection
