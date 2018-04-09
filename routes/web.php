<?php



Route::get('/', 'SoapController@obtenerListaBancos')->name('inicio');
Route::post('crearTransaccion', 'SoapController@crearTransaccion')->name('crearTransaccion.guardar');
Route::get('listarTransacciones', 'SoapController@listarTransacciones')->name('listarTransacciones');
Route::get('verTransaccion/{transactionID}', 'SoapController@obtenerTransaccion')->name('verTransaccion');




?>
