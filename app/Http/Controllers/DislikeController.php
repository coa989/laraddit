<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class DislikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (Like::where('user_id', auth()->id())
            ->where('likeable_id', $request->id)
            ->where('likeable_type', $request->class)
            ->first()) {

            self::danger('You have already voted!');
            return back();
        }

        Like::create([
            'user_id' => auth()->id(),
            'likeable_id' => $request->id,
            'likeable_type' => $request->class,
            'is_dislike' => 1
        ]);

        self::success('Your reaction has been recorded!');
        return back();
    }
}
