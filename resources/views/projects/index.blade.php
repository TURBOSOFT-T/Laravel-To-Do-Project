
@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
           
            <div class="pull-right">
                @can('project-create')
                <a class="btn btn-success" href="{{ route('projects.create') }}"> Create New Project</a>
                <a class="btn btn-success" href="{{ route('getDeleteProjects') }}"> View delected projects</a>
                @endcan
            </div>
            
        </div>
    </div>
    <div class="container">
        <div class="CRUD ToDoList">
            <h1>Project List</h1>
            <table class="table table-striped" border="3">
                <thead>
                    <tr>
                      <td>ID</td>
                      <td>Name</td>
                      <td>Autor</td>
                      <th>Date Deleted</th>
                      <td colspan="2">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data  as $key=> $project)
                    <tr>
                        <td>{{$project->id}}</td>
                        <td>{{$project->name}}</td>
                        <td>{{$project->user->name}}</td>
                        <td>{{$project->deleted_at}}</td>
                        
                        <td>
                            <form action="{{ route('projects.destroy',$project->id) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('projects.show',$project->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{route('projects.edit', $project->id)}}">Edit</a>
                                @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                      
                            </form>
                        </td>

                        <td>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>



@endsection


