@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center">Welcome to Myspace</h1>

            <div class="input-group mb-3 mt-5">
                <input type="text" class="form-control" placeholder="Search users...">

                <div class="input-group-append">
                    <span class="input-group-text">Search</span>
                </div>
            </div>

            <div class="row mt-4">
                @foreach ($users as $user)
                    <div class="col-sm">
                        <div class="card p-2 mb-3">
                            <div>
                                @if ($user->image)
                                    <img
                                        id="image_preview"
                                        width="128"
                                        height="128"
                                        src="{{ asset('storage/' . Auth::user()->image) }}"
                                        class="mb-3 rounded"
                                    />
                                @else
                                    <img
                                        id="image_preview"
                                        width="128"
                                        height="128"
                                        src="{{ asset('placeholder-avatar.jpg') }}"
                                        class="mb-3 rounded"
                                    />
                                @endif


                                <div>
                                    <div class="mt-2">
                                        <a href="{{ route('users.show', $user) }}" class="btn btn-primary">
                                            {{ Auth::check() ? $user->name . ' ' . $user->surname : $user->username }}'s Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
</div>
@endsection
