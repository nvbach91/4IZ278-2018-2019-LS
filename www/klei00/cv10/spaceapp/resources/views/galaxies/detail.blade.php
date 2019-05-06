@extends('layouts.app')
@section('content')
    <h1>{{$galaxy->name}}</h1>
    @if(count($stations)>0)
        <p>Stations in the galaxy:</p>    
            <ul class="list-group">
                @foreach ($stations as $station)
                    <li class="list-group-item">{{$station->name}}</li>  
                @endforeach                      
            </ul>
    @else
        <p>No Space Stations</p>
    @endif
   
@endsection

