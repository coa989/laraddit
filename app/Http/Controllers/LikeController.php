<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, $id)
    {
        if (Like::where('user_id', auth()->id())
            ->where('likeable_id', $id)
            ->where('likeable_type', $request->class)
            ->first()) {

            // TODO: add return message
            return back();
        }

        Like::create([
            'user_id' => auth()->id(),
            'likeable_id' => $id,
            'likeable_type' => $request->class,
        ]);

        self::success('Your reaction has been recorded!');

        return back();
    }
}
