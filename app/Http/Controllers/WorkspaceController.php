<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class WorkspaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $workspace = new Workspace();
        $workspace->name = $request->get('name');
        $workspace->location = $request->get('location');
        $workspace->project_id = $request->get('project_id');
        $workspace->save();

        return Redirect::route('workspaces.show', $workspace)->with('success', 'Workspace created.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Workspace $workspace)
    {
        $project = Auth::user()->project;

        // Load workspaces associated with the project
        $workspacesCount = Workspace::where('project_id', $project->id)->count();
        return Inertia::render('Workspace/WorkspaceShow', [
            'workspace' => $workspace,
            'workspacesCount' => $workspacesCount
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
