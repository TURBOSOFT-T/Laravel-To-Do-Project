<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $projects = Project::all();
       // $projects = Project::where('user_id',auth()->id)->get();
      // $projects= Project:: where('user_id', auth()->id() )->get();
     //  $tasks = Task::all();
     $tasks = Task:: where('project_id', auth()->id()  )->get();

        return view('tasks.index', compact('projects', 'tasks',));
          return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         $projects = Project::all();
        // $project = Project::create($request->all());
       $projects= Project:: where('user_id', auth()->id() )->get();
     return view('tasks.create', compact('projects'));
   //  return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['string', 'required'],
            'project' => ['required', 'numeric']

        ]);

        $project = Project::findOrFail($data['project']);
        $task = new Task();

        $task->name = $data['name'];


        $project->tasks()->save($task);
        //session()->flash("status", "success");
       // session()->flash("title", "Success!");
       /// session()->flash('message', "The task was created successfully!");
      // return redirect()->route('tasks.index');
      return redirect()->route('tasks.index')
      ->with('success','Task created successfully');
      // return response()->json($project, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {

        $request->validate([
            'name' => 'required',
            //'description' => 'required',
        ]);
    //  Task::WhereId($id)->update($request->all());
     $task->update($request->all());

        session()->flash("status", "success");
        session()->flash("title", "Success!");
        session()->flash('message', "The task was  updated successfully!");
        return redirect()->route('tasks.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        session()->flash("status", "success");
        session()->flash("title", "Success!");
        session()->flash('message', "The task was  deleted successfully!");
       return redirect()->route('tasks.index');
     // return response()->json('ok');
    }
}