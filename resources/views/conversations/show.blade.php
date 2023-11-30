@extends('layouts.app')


@section('content')
    <div class="container">
<div class="row">
    @include('conversations.users', ['users'=>$users])
        <div class="col-md-9 ">
            <div class="card">
                <h2> Show conversations</h2>
                <div class="card-header">{{$user->name}}</div>
                <div class ="card-body conversations">

                </div>

            </div>
            
        </div>
</div>   
    </div>


    
@endsection
