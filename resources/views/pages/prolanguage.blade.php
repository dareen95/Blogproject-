@extends('layout.app')
         
 
         @section('content')
            <div class="content">
                <div class="title m-b-md">
                  Programming languages
                </div>
            </div>
            
            
            <div class="content">
                <div class="title m-b-md">
                <ul>
                 @foreach($myname as $mynames)
              <li>   {{$mynames}}</li>
                 @endforeach
                 </ul>
                </div>
            </div>




            @endsection