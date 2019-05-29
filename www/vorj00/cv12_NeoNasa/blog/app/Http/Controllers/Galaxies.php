<?php

namespace App\Http\Controllers;

use App\Galaxy;
use App\Station;

class Galaxies extends Controller
{
    public function fetchAllGalaxy()
    {
        $galaxies = Galaxy::all();
        return view('galaxies', [
            'galaxies' => $galaxies,
        ]);
    }

    public function fetchAllSpaceStation()
    {
        $stationsList = Station::all();
        return view('stations', [
            'stationsList' => $stationsList,
        ]);
        // return $fetchAllSpaceStation = $mysqli->query('SELECT * FROM spaceStation');

    }

    public function fetchSpaceStation(Galaxy $galaxy)
    {
        //$galaxies = Galaxy::where('id', $galaxy->id)->get();
        $stations = Station::where('galaxy', $galaxy->id)->get();
        return view('station', [
            'galaxy' => $galaxy,
            'stations' => $stations,
        ]);
        // return $fetchSpaceStation = $mysqli->query('SELECT * FROM spaceStation WHERE galaxy ="' . $id . '" ');

    }
}
