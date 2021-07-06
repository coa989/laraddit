<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class DislikeController extends Controller
{
    public function store(Request $request, $id)
    {
        if (Like::where('user_id', auth()->id())
            ->where('likeable_id', $id)
            ->where('likeable_type', $request->class)
            ->first()) {

            return back();
        }

        Like::create([
            'user_id' => auth()->id(),
            'likeable_id' => $id,
            'likeable_type' => $request->class,
            'is_dislike' => 1
        ]);

        self::success('Your reaction has been recorded!');

        return back();
    }
}
