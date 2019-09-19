<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        // Only allow the owner to edit his profile
        if (Auth::user() == $user) {
            return view('users.edit', compact('user'));
        }

        redirect(route('home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $v = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'alpha_num', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'alpha_num', 'min:5', 'max:6'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'image' => ['sometimes', 'file', 'image', 'max:5000'],
            Rule::unique('users')->ignore($user->email),
            Rule::unique('users')->ignore($user->username),
            'new_password' =>
            ['nullable', 'different:password', 'min:8', 'confirmed'],
        ]);

        $data = [
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'relationship_status' => $request->relationship_status,
            'email' => $request->email,
        ];

        if ($data['relationship_status'] == 'taken') {
            $data['relationship_status'] = 1;
        } else {
            $data['relationship_status'] = 0;
        }

        // Only validate if a new password is provided
        if (isset($v['new_password'])) {
            if ($request->password && Hash::check(
                $request->password,
                $user->getAuthPassword()
            )) {

                // Encrypt and append the new password to data
                $data['password'] = Hash::make($request->new_password);
            } else {
                $error = ValidationException::withMessages([
                    'incorrect_password' => [
                        'The entered password does not match your current password.'
                    ],
                ]);

                throw $error;
            }
        }

        if ($request->has('image')) {

            // Unlink the old image from storage
            if (Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // Append to data so we don't have to query twice
            $data['image'] = $request->image->store('uploads', 'public');
        }

        $user->update($data);

        return redirect(route('users.show', $user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}