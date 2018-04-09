<?php
namespace App;
use SoapClient;
use Illuminate\Database\Eloquent\Model;

/**
* clase para o modelo para conectar al servicio 
 * author: Diego Duran
 * version: 1
 * since : 9/04/2018
 *version : 1
 */
class Conexion   extends Model 
{


/**
* Funcion para obtener array de auth para  el cliente soap
 * author: Diego Duran
 * version: 1
 * since : 5/04/2018
 * param : none
 * return : array auth
 *version : 1
 */
  public  static function obtenerArrayAutenticacion(){
      $login = '6dd490faf9cb87a9862245da41170ff2';
      $seed  = date( 'c' );
      $tranKey = '024h1IlD';
      $hashkey = sha1($seed.$tranKey,false);
      $paramAuth = array(
                              'login'      => $login,
                              'tranKey'    => $hashkey,
                              'seed'       => $seed
                            );
      
       return  $paramAuth; 
  }



/**
* Funcion para conectar e  instanciar y obtener el cliente soap
 * author: Diego Duran
 * version: 1
 * since : 6/04/2018
 * param : none
 * return : CLiente soap
 *version : 1
 */

  public static  function obtenerClienteSOAP(){
     
      $url = "https://test.placetopay.com/soap/pse/?wsdl";
      $client = new SoapClient($url,['trace' => true, 'cache_wsdl' => WSDL_CACHE_MEMORY]);
      $client->__setLocation('https://test.placetopay.com/soap/pse');
      return $client;

  }





}