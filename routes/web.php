<?php



Route::get('/', 'SoapController@obtenerListaBancos');
Route::post('crearTransaccion', 'SoapController@crearTransaccion')->name('crearTransaccion.guardar');
Route::get('listarTransacciones', 'SoapController@listarTransacciones')->name('listarTransacciones');




?>
