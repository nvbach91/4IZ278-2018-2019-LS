<?php

namespace App\Http\Controllers;

use App\Galaxy;
use App\Station;
use Illuminate\Http\Request;

class GalaxyController extends Controller
{
    public function index()
    {
        $galaxies = Galaxy::all();

        return view('galaxies.index', [
            'galaxies' => $galaxies,
        ]);
    }

    public function detail(Galaxy $galaxy)
    {   
        $stations = Station::where('galaxy_id', $galaxy->id)->get();

        return view('galaxies.detail', [
            'galaxy' => $galaxy,
            'stations' => $stations,
        ]);
    }
}
