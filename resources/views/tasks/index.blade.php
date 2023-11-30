
@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
           
            <div class="pull-right">
                @can('task-create')
                <a class="btn btn-success" href="{{ route('tasks.create') }}"> Create New Task</a>
                @endcan
            </div>
        </div>
    </div>
    <div class="container">
        <div class="CRUD ToDoList">
            <h1>Task List</h1>
            <table class="table table-striped" border="3">
                <thead>
                    <tr>
                      <td>ID</td>
                      <td>Name</td>
                      <td>Project</td>
                      <td colspan="2">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->name}}</td>
                        <td>{{$task->project->name}}</td>
                        
                        <td>
                            <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('tasks.show',$task->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{route('tasks.edit', $task->id)}}">Edit</a>
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

  


