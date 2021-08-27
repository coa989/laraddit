<?php

namespace App\Http\Controllers;

use App\Components\FlashMessages;
use App\Http\Requests\StoreLikeDislikeRequest;
use App\Models\Like;

class LikeController extends Controller
{
    use FlashMessages;

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

        Like::create($request->validated());

        self::success('Your reaction has been recorded!');
        return back();
    }
}
