<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Workspace;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ProjectDashboardController extends Controller
{
    public function __invoke(): Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        $project = Auth::user()->project;

        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        // Load workspaces associated with the project
        $workspacesCount = Workspace::where('project_id', $project->id)->count();

        if ($workspacesCount === 0) {

            return redirect(route('workspaces.create', $project));
        } elseif ($workspacesCount === 1) {

            return redirect(route('workspaces.show', Workspace::where('project_id', $project->id)->first()));
        }
            return redirect(route('project.dashboard', $project->load('workspaces')));

    }
}
