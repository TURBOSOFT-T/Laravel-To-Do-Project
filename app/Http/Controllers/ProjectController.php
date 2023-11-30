<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /* function __construct()
    {
         $this->middleware('permission:project-list|project-create|project-edit|project-delete', ['only' => ['index','show']]);
         $this->middleware('permission:project-create', ['only' => ['create','store']]);
         $this->middleware('permission:project-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:project-delete', ['only' => ['destroy']]);
    } */
    public function index(Request $request)
    {


         // $projects = Project::all();
      // $projects = Project::where('user_id',auth()->id)->get();
    // $projects= Project:: where('user_id', auth()->id() )->get();
     // $current_project = Project::findOrFail($id);
     // $tasks = $current_project->tasks;
       // $projects = Project::latest()->paginate(5);
       $data = Project::orderBy('id','DESC')->paginate(10);
        return view('projects.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate(
            [
                'name' => ['string', 'required', 'unique:projects']
            ]
        );
        Project::create(array_merge($request->only('name'),[
            'user_id' => auth()->id()
        ]));

        //Project::create($request->all());
       // $project= new Project();
      //  $project->name = $data['name'];
       // $project->save();
        session()->flash("status", "success");
        session()->flash("title", "Success!");

        session()->flash('message', "The project was created successfully!");
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        request()->validate([
            'name' => 'required',
           // 'detail' => 'required',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')
                        ->with('success','Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
                        ->with('success','Project deleted successfully');
    }


    public function search($name)
    {
        //
        return Project::where('name','like','%'.$name.'%')->get();
    }


    public function restoreDeletedProjects($id)
    {

        $project = Project::where('id', $id)->withTrashed()->first();

        $project->restore();

        return redirect()->route('projects.index')
            ->with('success', 'You successfully restored the project');
    }
    public function deletePermanently($id)
    {
        $project = Project::where('id', $id)->withTrashed()->first();

        $project->forceDelete();

        return redirect()->route('projects.index')
            ->with('success', 'You successfully deleted the project fromt the Recycle Bin');

    }

    public function getDeleteProjects() {
        $projects = Project::onlyTrashed()->paginate(10);

        return view('projects.deletedprojects', compact('projects'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
}