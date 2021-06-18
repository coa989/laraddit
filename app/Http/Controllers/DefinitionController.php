<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDefinitionRequest;
use App\Models\Definition;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DefinitionController extends Controller
{
    public function index()
    {
        $definitions = Definition::all();
        return view('definitions.index', ['definitions' => $definitions]);
    }

    public function create()
    {
        return view('definitions.create');
    }

    public function store(StoreDefinitionRequest $request)
    {
        $slug = Str::slug($request->title);

        $definition = Definition::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
            'slug' => $slug
        ]);

        if ($request->tags) {
            $tags = explode(',', str_replace(' ', '', $request->tags));
            foreach ($tags as $tag) {
                $find_tag = Tag::where('name', strtolower($tag))->first();
                if ($find_tag){
                    $definition->tags()->attach($find_tag->id);
                } else {
                    $new_tag = Tag::create(['name' => $tag]);
                    $definition->tags()->attach($new_tag->id);
                }
            }
        }

        return redirect('definitions');
    }
}
