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

            @auth
                <form>
                    <button class="btn btn-primary like-button">Like</button>
                </form>

                <span style="{{ $liked->count() ? '' : 'display: none;' }}" class="already-liked">
                    You've liked this profile
                </span>
            @endauth
        </div>

        <div class="col-md-10 card p-2">
            @auth
                <div>
                    <b>Name:</b> {{ $user->name }}
                </div>

                <div>
                    <b>Surname:</b> {{ $user->surname }}
                </div>
            @endauth

            <div>
                <b>Username:</b> {{ $user->username }}
            </div>

            @auth
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

                <div>
                    <b>Likes:</b> <span id="likes">{{ $user->likes->count() }}</span>
                </div>

                {{-- Only display edit button if owned by user  --}}

                @if(Auth::user()->id == $user->id)
                    <div class="pt-2">
                        <a class='btn btn-primary' href="{{ route('users.edit', Auth::user()) }}">Edit Profile</a>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.like-button').click(function(e) {
            e.preventDefault();

            var user = {!! json_encode($user->toArray()) !!};

            $.ajax({
                type: 'POST',
                data: {
                    'id': user.id
                },
                url: "{{ route('likes.post') }}",
                success: function(data) {
                    var likesObj = $('#likes');

                    if (data.success) {
                        likesObj.html(parseInt(likesObj.html()) + 1);

                        $('.already-liked').show();
                    } else {
                        likesObj.html(parseInt(likesObj.html()) - 1);

                        $('.already-liked').hide();
                    }
                }
            });
        });
    })
</script>
@endsection
