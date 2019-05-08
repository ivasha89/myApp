<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:view,project')->except('create');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param User $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $user = auth()->user();
        $request->validate([
           'title' => 'required|string|min:3',
           'description' => 'required|string|min:3|unique:projects'
        ]);

        Project::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description
        ]);

        session()->flash('message', 'Задача создана. Добавьте подпункты к задаче');

        return redirect("/$user->id/projects");
    }

    /**
     * Display the specified resource.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $user = auth()->user();
        return view('projects.show', compact('project', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit')->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:3'
        ]);
        Project::find($project->id)
            ->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
        return redirect("/projects/$project->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $user = $project->user;
        session()->flash('message', "Проект $project->title удалён");
        $project->delete();
        return redirect("/$user->id");
    }
}
