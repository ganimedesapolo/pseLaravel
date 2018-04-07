<?php
namespace App\Http\Controllers;
use SoapClient;
use Illuminate\Http\Request;

class SoapController 
{




/**
* Funcion para obtener array de auth para  el cliente soap
 * author: Diego Duran
 * version: 1
 * since : 7/03/2018
 * param : none
 * return : array auth
 *version : 1
 */
  public function obtenerArrayAutenticacion(){
      $login = '6dd490faf9cb87a9862245da41170ff2';
      $seed  = date( 'c' );
      $tranKey = '024h1IlD';
      $hashkey = sha1($seed.$tranKey,false);
      $paramAuth = array(
                              'login'      => $login,
                              'tranKey'    => $hashkey,
                              'seed'       => $seed
                            );
       $auth   = array('auth' => $paramAuth);

       return  $auth; 
  }



/**
* Funcion para conectar e  instanciar y obtener el cliente soap
 * author: Diego Duran
 * version: 1
 * since : 7/04/2018
 * param : none
 * return : CLiente soap
 *version : 1
 */

  public function obtenerClienteSOAP(){
     
      $url = "https://test.placetopay.com/soap/pse/?wsdl";
      $client = new SoapClient($url,['trace' => true, 'cache_wsdl' => WSDL_CACHE_MEMORY]);
      $client->__setLocation('https://test.placetopay.com/soap/pse');
      return $client;

  }



/**
* Funcion para obtener la lista de los bancos
 * author: Diego Duran
 * version: 1
 * since : 7/02/2018
 * param : none
 * return : Lista de banco a la vista
 *version : 1
 */
public function obtenerListaBancos(){
      $client = $this->obtenerClienteSOAP();
      $auth = $this->obtenerArrayAutenticacion();
          try{
              $result = $client->getBankList($auth);
              // dd($result);
               }
          catch(SoapFault $fault) {
              echo '<br>'.$fault;
          }
          return view('inicio',compact('result'));
    }




/**
* Funcion para enviar  y crear la transaccion
 * author: Diego Duran
 * version: 1
 * since : 7/02/2018
 * param : none
 * return : Lista de banco a la vista
 *version : 1
 */

 public function crearTransaccion(Request $request ){
      return $this->obtenerListaBancos();
  }









    
}
