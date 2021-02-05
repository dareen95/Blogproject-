@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                   <a href="/posts/create" class="btn btn-primary btn-lg">New post !</a>
                
                
                <hr>
                @foreach($posts as $post)
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$post->subject}}</h3>
                    </div>
                    <div class="panel-body">
                        {!!$post->body!!}

  
                    </div>
    <div class="panel-footer">
     <a   href="/posts/{{$post->id}}/edit" class="btn btn-primary  ">Edit</a>
  
  {!! Form::open(['action' => ['PostsController@destroy',$post->id], 'method'=>'POST']) !!}
  {{Form::hidden('_method' ,'DELETE') }}
   {{Form::submit('Delete',['class'=>"pull-right btn btn-danger btn-sm"]) }}
{!! Form::close() !!}
    
    </div>                
                </div>
                @endforeach
                
                
                
                </div>
            </div>
        </div>
    </div>
</div>









@endsection
