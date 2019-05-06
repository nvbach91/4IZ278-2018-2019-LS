<?php

namespace App\Http\Controllers;

use App\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index()
    {
        $stations = Station::all();

        return view('stations.index', [
            'stations' => $stations,
        ]);
    }

    public function detail(Station $station)
    {
        return view('stations.detail', [
            'station' => $station,
        ]);
    }
}
