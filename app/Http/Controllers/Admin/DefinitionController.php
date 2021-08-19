<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Definition;
use App\Models\Post;

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
        $definition->update([
            'approved' => true,
            'rejected' => false
        ]);

        return back();
    }

    public function reject(Definition $definition)
    {
        $definition->update([
            'rejected' => true,
            'approved' => false
        ]);

        return back();
    }


    public function approved()
    {
        $definitions = Definition::where('approved', true)
            ->latest()
            ->paginate(8);

        return view('admin.definitions.approved', ['definitions' => $definitions]);
    }

    public function rejected()
    {
        $definitions = Definition::where('rejected', true)
            ->latest()
            ->paginate(8);

        return view('admin.definitions.rejected', ['definitions' => $definitions]);
    }

    public function pending()
    {
        $definitions = Definition::where('approved', false)
            ->where('rejected', false)
            ->latest()
            ->paginate(8);

        return view('admin.definitions.pending', ['definitions' => $definitions]);
    }
}
