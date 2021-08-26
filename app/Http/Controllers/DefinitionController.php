<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDefinitionRequest;
use App\Models\Comment;
use App\Models\Definition;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DefinitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $definitions = Definition::where('approved', true)
            ->with('user', 'tags', 'comments', 'likes')
            ->latest()
            ->paginate(15);

        $popularTags = Tag::popular('definition');

        return view('definitions.index', ['definitions' => $definitions, 'tags' => $popularTags]);
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
     * @param StoreDefinitionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreDefinitionRequest $request)
    {
        if (auth()->user()->cannot('store', Definition::class)) {
            self::danger('You have reached daily definition upload limit! Please try again later.');
            return back();
        }

        $definition = Definition::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->title)
        ]);

        if ($request->tag_list) {
            Tag::handle($definition, $request);
        }

        self::success('Definition created successfully! It will be visible when admin approves it.');

        return redirect()->route('definitions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $definition
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Definition $definition)
    {
        $comments = $definition->comments()->with('replies', 'user', 'replies.user')->get();
        return view('definitions.show', [
            'definition' => $definition,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
     * @param Definition $definition
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Definition $definition)
    {
        $this->authorize('delete-definition', $definition);

        $definition->tags()->detach();

        $definition->delete();

        return redirect()->route('definitions.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function hot()
    {
        $definitions = Definition::with('user', 'tags')
            ->where('approved', true)
            ->whereDate('created_at', Carbon::today())
            ->orderBy('ratings', 'DESC')
            ->paginate(10);

        $popularTags = Tag::popular('definition');

        return view('definitions.hot', ['definitions' => $definitions, 'tags' => $popularTags]);
    }
}
