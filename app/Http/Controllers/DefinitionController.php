<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDefinitionRequest;
use App\Models\Definition;
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

        Definition::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
            'slug' => $slug
        ]);

        return redirect('definitions');
    }
}
