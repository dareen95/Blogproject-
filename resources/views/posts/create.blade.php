@extends('layout.app')
           
           
            @section('content')
           
           
{!! Form::open(['action' => 'PostsController@store', 'method'=>'POST','enctype'=>'multipart/form-data']) !!}
 

   <div class=container>
<div class="form-group">
      {{Form::label('subject', 'Subject')}}
      {{Form::text('subject','' , ['class'=>'form-control'] ) }}
    </div>
 <div class="form-group">
      {{Form::label('firstname', 'First name')}}
      {{Form::text('firstname','',['class'=>'form-control']) }}
    </div>

<div class="form-group">
      {{Form::label('lastname', 'Last name')}}
      {{Form::text('lastname','',['class'=>'form-control' ]) }}
    </div>

<div class="form-group">
      {{Form::label('body', 'Discriptions')}}
      {{Form::textarea('body','',['class'=>'form-control' ,'id'=>'article-ckeditor']) }}
    </div>

   
 
<div class="form-group">
      
      {{Form::file('post_image', ['class'=>'btn ' ]) }}
    </div>   
 
{{Form::submit('Create',['class'=>'btn btn-primary btn-lg' ] ) }}

   </div>


{!! Form::close() !!}
 
    
           @endsection



 

