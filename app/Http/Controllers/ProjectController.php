<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Skill;
use App\Models\Project;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        // Get the current logged in user's ID
        $user_id = auth()->user()->id ?? null;

        // Get only the projects created by the current user
        $projects = ProjectResource::collection(
            Project::where('user_id', $user_id)
                ->with('skill')
                ->orderBy('id')
                ->get()
        );

        return Inertia::render('Projects/Index', compact('projects'));
    }

    public function create()
    {
        $skills = Skill::all();
        return Inertia::render('Projects/Create', compact('skills'));
    }

    public function store(Request $request)
{
    if (!auth()->check()) {
        return Redirect::route('login');
    }

    $request->validate([
        'image' => ['required', 'image'],
        'name' => ['required', 'min:3'],
        'skill_id' => ['required']
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image')->store('projects');
        Project::create([
            'user_id' => auth()->id(),
            'skill_id' => $request->skill_id,
            'name' => $request->name,
            'image' => $image,
            'project_url' => $request->project_url
        ]);

        return Redirect::route('projects.index')->with('message', 'Project Created Successfully');
    }

    return Redirect::back();
}

    public function edit(Project $project)
    {
        $skills = Skill::all();
        return Inertia::render('Projects/Edit', compact('project', 'skills'));
    }

    public function update(Request $request, Project $project)
    {
        $image = $project->image;
        $request->validate([
            'name' => ['required', 'min:3'],
            'skill_id' => ['required'],
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($project->image);
            $image = $request->file('image')->store('projects');
        }

        $project->update([
            'name' => $request->name,
            'skill_id' => $request->skill_id,
            'project_url' => $request->project_url,
            'image' => $image
        ]);

        return Redirect::route('projects.index')->with('message', 'Project Updated Successfully');
    }

    public function destroy(Project $project)
    {
        Storage::delete($project->image);
        $project->delete();
        return Redirect::back()->with('message', 'Project Deleted Successfully');
    }
}
