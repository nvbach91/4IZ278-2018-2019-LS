@extends('layouts.app')


@section('content')
    <h1>Galaxies</h1>
    @if(count($galaxies)>0)
        @foreach ($galaxies as $galaxy)
            <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                                <a href="./galaxies/{{$galaxy->id}}"><img src="/~klei00/cv10/storage/galaxies/{{$galaxy->image_url}}" class="card-img" alt="{{$galaxy->name}}"></a>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                            <h2 class="card-title"><a href="./galaxies/{{$galaxy->id}}">{{$galaxy->name}}</a></h2>
                            <p class="card-text">{{"Volume: ".$galaxy->volume}}</p>
                            </div>
                        </div>
                    </div>
            </div>
        @endforeach
    @else 
        <p>No galaxies</p>
    @endif
@endsection
