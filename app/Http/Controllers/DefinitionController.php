<?php

namespace App\Http\Controllers;

use App\Components\FlashMessages;
use App\Http\Requests\StoreDefinitionRequest;
use App\Models\Comment;
use App\Models\Definition;
use App\Models\Like;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DefinitionController extends Controller
{
    use FlashMessages;

    public function index()
    {
        $definitions = Definition::where('approved', true)
            ->with('user', 'tags', 'comments', 'likes')
            ->latest()
            ->paginate(15);

        return view('definitions.index', ['definitions' => $definitions]);
    }

    public function store(StoreDefinitionRequest $request)
    {
        if (auth()->user()->cannot('store', Definition::class)) {
            self::danger('You have reached daily definition upload limit! Please try again later.');

            return back();
        }

        $slug = Str::slug($request->title);

        $definition = Definition::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
            'slug' => $slug
        ]);

        if ($request->tags) {
            $this->tags($definition, $request);
        }

        self::success('Definition created successfully! It will be visible when admin approves it.');

        return redirect()->route('definitions.index');
    }

    public function show(Definition $definition)
    {
        return view('definitions.show', ['definition' => $definition]);
    }

    public function destroy(Definition $definition)
    {
        if (auth()->user()->cannot('delete', $definition)) {
            abort(403);
        }

        $definition->delete();

        return redirect()->route('definitions.index');
    }

    public function hot()
    {
        $definitions = Definition::where('approved', true)->whereDate('created_at', Carbon::today())
            ->orderBy('ratings', 'DESC')
            ->paginate(10);

        return view('definitions.hot', ['definitions' => $definitions]);
    }

    public function tag(Tag $tag)
    {
        $tagsId = $tag->id;

        $definitions = Definition::whereHas('tags', function ($query) use($tagsId) {
            $query->where('definition_tag.tag_id', $tagsId);
        })->latest()->paginate(15);

        return view('definitions.index', ['definitions' => $definitions]);
    }
}
