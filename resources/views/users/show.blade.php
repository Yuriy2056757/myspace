@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div>
                @if ($user->image)
                    <img
                        id="image_preview"
                        width="160"
                        height="160"
                        src="{{ asset('storage/' . Auth::user()->image) }}"
                        class="mb-3 rounded"
                    />
                @else
                    <img
                        id="image_preview"
                        width="160"
                        height="160"
                        src="{{ asset('placeholder-avatar.jpg') }}"
                        class="mb-3 rounded"
                    />
                @endif
            </div>
        </div>

        <div class="col-md-10 card p-2">
            <div>
                <b>Name:</b> {{ Auth::user()->name }}
            </div>

            <div>
                <b>Surname:</b> {{ Auth::user()->surname }}
            </div>

            <div>
                <b>Username:</b> {{ Auth::user()->username }}
            </div>

            <div>
                <b>E-Mail:</b> {{ Auth::user()->email }}
            </div>

            <div>
                <b>Address:</b> {{ Auth::user()->address }}
            </div>

            <div>
                <b>Zip Code:</b> {{ Auth::user()->zipcode }}
            </div>

            <div>
                <b>Relationship Status:</b> {{ Auth::user()->relationship_status == 1 ? 'Taken' : 'Single' }}
            </div>

            <div class="pt-2">
                <a class='btn btn-primary' href="{{ route('users.edit', Auth::user()) }}">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
@endsection
