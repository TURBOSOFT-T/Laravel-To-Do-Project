<?php

namespace App\Http\Controllers\API;
use App\Models\Project;
use App\Models\Task;
use DB;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /* function __construct()
    {
         $this->middleware('permission:project-list|project-create|project-edit|project-delete', ['only' => ['index','show']]);
         $this->middleware('permission:project-create', ['only' => ['create','store']]);
         $this->middleware('permission:project-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:project-delete', ['only' => ['destroy']]);
    } */
    public function index(Request $request)
    {


          $projects = Project::all();
     // $projects = Project::where('user_id',auth()->id)->get();
    // $projects= Project:: where('user_id', auth()->id() )->get();
   //  $current_project = Project::findOrFail($id);
     // $tasks = $current_project->tasks;
        //$projects = Project::first()->paginate(5);
       // return view('projects.index',compact('projects'))
           // ->with('i', (request()->input('page', 1) - 1) * 5);

            return response()->json($projects);
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

       
        Project::create(array_merge($request->only('name'),[
            'user_id' => auth()->id()
        ]));
        $data = $request->validate(
            [
                'name' => ['string', 'required', 'unique:projects']
            ]
        );

        $project= new Project();
        $project->name = $data['name'];
        $project->save();
        session()->flash("status", "success");
        session()->flash("title", "Success!");
    
        session()->flash('message', "The project was created successfully!");

        return response()->json($projects);
       // return redirect()->route('projects.index');
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

        return response()->json($projects);
    
        //return redirect()->route('projects.index')
                    //    ->with('success','Project updated successfully');
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
    
       // return redirect()->route('projects.index')
                  //      ->with('success','Project deleted successfully');
                  return response()->json($projects);
    }
}
