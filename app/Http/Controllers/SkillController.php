<?php

namespace App\Http\Controllers;

use App\Http\Resources\SkillResource;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Project;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SkillController extends Controller
{
    public function index()
    {
        // Get the current logged in user's ID
        $user_id = auth()->user()->id ?? null;

        // Get only the projects created by the current user
        $skills = SkillResource::collection(
            Skill::where('user_id', $user_id)
                ->orderBy('id')
                ->get()
        );
        return Inertia::render('Skills/Index', compact('skills'));
    }

    public function create()
    {
        return Inertia::render('Skills/Create');
    }

    public function store(Request $request)
{
    $request->validate([
        'image' => ['required', 'image'],
        'name' => ['required', 'min:3']
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image')->store('skills');

        // Get the user_id value from the currently authenticated user
        $user_id = auth()->user()->id;

        Skill::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'image' => $image
        ]);

        return Redirect::route('skills.index')->with('message', 'Skill Created Successfully');
    }

    return Redirect::back();
}

    public function edit(Skill $skill)
    {
        return Inertia::render('Skills/Edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $image = $skill->image;
        $request->validate([
            'name' => ['required', 'min:3']
        ]);
        if($request->hasFile('image')){
            Storage::delete($skill->image);
            $image = $request->file('image')->store('skills');
        }

        $skill->update([
            'name' =>$request->name,
            'image' =>$image
        ]);

        return Redirect::route('skills.index')->with('message', 'Skill Updated Successfully');
    }

    public function destroy(Skill $skill)
    {
        Storage::delete($skill->image);
        $skill->delete();

        return Redirect::back()->with('message', 'Skill Deleted Successfully');
    }
}
