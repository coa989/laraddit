<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Definition;
use Illuminate\Http\Request;

class DefinitionController extends Controller
{
    public function index()
    {
        $definitions = Definition::with('user')
            ->latest()
            ->paginate(8);

        return view('admin.definitions.index', ['definitions' => $definitions]);
    }

    public function show(Definition $definition)
    {
        return view('admin.definitions.show', ['definition' => $definition]);
    }

    public function destroy(Definition $definition)
    {
        $definition->delete();

        return redirect()->route('admin.definitions');
    }

    public function approve(Definition $definition)
    {
        $definition->update(['approved' => true]);

        return back();
    }

    public function approved()
    {
        $definitions = Definition::where('approved', true)->paginate(8);

        return view('admin.definitions.approved', ['definitions' => $definitions]);
    }

    public function waiting()
    {
        $definitions = Definition::where('approved', false)->paginate(8);

        return view('admin.definitions.waiting', ['definitions' => $definitions]);
    }
}
