<?php
namespace App\Http\Controllers;
use SoapClient;
use Illuminate\Http\Request;

class SoapController 
{


public function conexion(){
     
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


    $url = "https://test.placetopay.com/soap/pse/?wsdl";

    try{
        $client = new SoapClient($url,['trace' => true, 'cache_wsdl' => WSDL_CACHE_MEMORY]);
        $client->__setLocation('https://test.placetopay.com/soap/pse');
        $result = $client->getBankList($auth);
    
    // dd($result);

    }
    catch(SoapFault $fault) {
        echo '<br>'.$fault;
    }

    return view('inicio',compact('result'));
       
    }



  public function store(Request $request ){
      fdfasfsfsf
      dd($request->all());

    }



    
}
