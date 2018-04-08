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
   


   $bankCode=$request->get('idBanco');
   $bankInterface = '0';
   $returnUrl = 'https://www.banco.colpatria.com.co/banca-virtual/';
   $reference = 'sdertertrt465etgt4tttr';
   $description = $request->get('descripcionPago');
   $language = 'es';
   $currency = 'COP';

   $totalAmount = $request->get('totalCantidad');
   $taxAmount = $request->get('impuesto');
   $devolutionBase = $request->get('devolucionBase');
   $tipAmount = $request->get('propina');

   $person = array(
                     'document' => $request->get('documentoPersona'),
                     'documentType' =>$request->get('tipoDocumento'),
                     'firstName' =>$request->get('firstName'),
                     'lastName' =>$request->get('lastName'),
                     'company' =>$request->get('company'),
                     'emailAddress' =>$request->get('emailAddress'),
                     'address' =>$request->get('address'),
                     'city' =>$request->get('city'),
                     'province' =>$request->get('province'),
                     'country' =>$request->get('country'),
                     'phone' =>$request->get('phone'),
                     'mobile' =>$request->get('mobile'),
                            );
       

   $ipAddress =  $request->ip();
   $userAgent = $request->header('User-Agent');

  

  $PSETransactionRequest = array(
         'bankCode' => $bankCode,
         'bankInterface' =>  $bankInterface,
         'returnURL' => $returnUrl,
         'reference' =>  $reference,
         'description' => $description,
         'language' => $language,
         'currency' => $currency,
         'totalAmount' => floatval($totalAmount),
         'taxAmount'=> floatval($taxAmount),
         'devolutionBase' => floatval($devolutionBase),
         'tipAmount' => floatval($tipAmount),
         'payer' => $person,
         'buyer' => $person,
         'shipping' => $person,
         'ipAddress' => $ipAddress,
         'userAgent' => $userAgent

  );


     $auth = $this->obtenerArrayAutenticacion();
     $auntetificacion = $auth['auth'];
     $params = array( 'auth' => $auntetificacion   ,'transaction' =>   $PSETransactionRequest);
   //  dd($params);
     $client = $this->obtenerClienteSOAP();
     
 
      try{
              $result = $client->createTransaction($params);
         }
          catch(SoapFault $fault) {
              echo '<br>'.$fault;
          }

  dd($result);
   



  }









    
}
