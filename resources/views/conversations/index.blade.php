@extends('layouts.app')


@section('content')
<div class="container" color="red">
	
	    <div class="list-group">
        @foreach ($users as $user)
	        <a>{{ $user->name }}</a>
            @endforeach
      </div>
	  
</div>





@endsection