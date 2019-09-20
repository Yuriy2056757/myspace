<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    // Returns true if a new like is created,
    // and false if an existing one was removed
    public function storeOrDelete($user_id, $user_liked_id)
    {
        $like = Like::where('user_id', $user_id)->where('user_liked_id', $user_liked_id)->first();

        // Remove like if it exists
        if ($like) {
            $like->delete();

            return false;
        }

        Like::create([
            'user_id' => $user_id,
            'user_liked_id' => $user_liked_id
        ]);

        return true;
    }

    public function ajaxRequest(Request $request)
    {
        $isNewLikeCreated = $this->storeOrDelete($request->id, Auth::user()->id);

        return response()->json(['success' => $isNewLikeCreated]);
    }
}