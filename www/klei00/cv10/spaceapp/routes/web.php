<?php

Route::get('/', function () {
    return redirect('/galaxies');
});
Route::get('/stations', 'StationController@index')->name('stations.index');
//Route::get('/stations/{station}', 'StationController@detail')->name('stations.detail');

Route::get('/galaxies', 'GalaxyController@index')->name('galaxies.index');
Route::get('/galaxies/{galaxy}', 'GalaxyController@detail')->name('galaxies.detail');
