@extends('layouts.app')


@section('content')
    <h1>Space Stations</h1>
    @if(count($stations)>0)
        @foreach ($stations as $station)
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/~klei00/cv10/storage/stations/{{$station->image_url}}" class="card-img" alt="{{$station->name}}"></a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title">{{$station->name}}</h2>
                            <small>{{"Station Id:".$station->id}}</small>
                            <p>{{"Coord: X: ".$station->coord_x."; Y: ".$station->coord_y."; Z: ".$station->coord_z}}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No Space Stations</p>
    @endif
@endsection
