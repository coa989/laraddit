<?php

namespace App\Http\Controllers;

use App\Components\FlashMessages;
use App\Http\Requests\StoreDefinitionRequest;
use App\Models\Comment;
use App\Models\Definition;
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

        $popularTags = Tag::popular('definition');

        return view('definitions.index', ['definitions' => $definitions, 'tags' => $popularTags]);
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

        if ($request->tag_list) {
            Tag::handle($definition, $request);
        }

        self::success('Definition created successfully! It will be visible when admin approves it.');

        return redirect()->route('definitions.index');
    }

    public function show(Definition $definition)
    {
        $comments = Comment::where('commentable_id', $definition->id)->with('replies', 'user', 'replies.user')->get();
        return view('definitions.show', [
            'definition' => $definition,
            'comments' => $comments
            ]);
    }

    public function destroy(Definition $definition)
    {
        $this->authorize('delete-definition', $definition);

        $definition->tags()->detach();

        $definition->delete();

        return redirect()->route('definitions.index');
    }

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
