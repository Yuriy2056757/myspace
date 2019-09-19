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
                <b>Name:</b> {{ $user->name }}
            </div>

            <div>
                <b>Surname:</b> {{ $user->surname }}
            </div>

            <div>
                <b>Username:</b> {{ $user->username }}
            </div>

            <div>
                <b>E-Mail:</b> {{ $user->email }}
            </div>

            <div>
                <b>Address:</b> {{ $user->address }}
            </div>

            <div>
                <b>Zip Code:</b> {{ $user->zipcode }}
            </div>

            <div>
                <b>Relationship Status:</b> {{ $user->relationship_status == 1 ? 'Taken' : 'Single' }}
            </div>

            {{-- Only display edit button if profile is owned by user  --}}
            @if(Auth::user() == $user)
                <div class="pt-2">
                    <a class='btn btn-primary' href="{{ route('users.edit', Auth::user()) }}">Edit Profile</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
