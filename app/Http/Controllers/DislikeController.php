<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLikeDislikeRequest;
use App\Models\Like;

class DislikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * *
     * @param StoreLikeDislikeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreLikeDislikeRequest $request)
    {
        if (Like::where('user_id', $request->user_id)
            ->where('likeable_id', $request->likeable_id)
            ->where('likeable_type', $request->likeable_type)
            ->first()) {

            self::danger('You have already voted!');
            return back();
        }

        Like::create([
            'user_id' => $request->user_id,
            'likeable_id' => $request->likeable_id,
            'likeable_type' => $request->likeable_type,
            'is_dislike' => 1
        ]);

        self::success('Your reaction has been recorded!');
        return back();
    }
}
