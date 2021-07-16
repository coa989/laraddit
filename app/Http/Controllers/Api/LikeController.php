<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLikeRequest;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Post[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreLikeRequest $request)
    {
        Like::create([
            'user_id' => $request->user_id,
            'likeable_id' => $request->id,
            'likeable_type' => $request->type,
        ]);

        $class = $request->type;

        return response()->json([
                'success' => 'Your reaction has been recorded!',
                'likes' => $class::find($request->id)->likes_count
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param $type
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, $type)
    {
        return response()->json([
            'likes' => $type::find($id)->likes_count
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
