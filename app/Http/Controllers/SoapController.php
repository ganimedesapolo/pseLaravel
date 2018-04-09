<?php
namespace App\Http\Controllers;
use SoapClient;
use Illuminate\Http\Request;
use App\Person;
use App\Transaction;
class SoapController 
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
 * since : 7/04/2018
 * param : none
 * return : Lista de banco a la vista
 *version : 1
 */
public function obtenerListaBancos(){
      $client = $this->obtenerClienteSOAP();
      $atentificacion = $this->obtenerArrayAutenticacion();
      $auth   = array('auth' => $atentificacion);
          try{
              $result = $client->getBankList($auth);
              // dd($result);
               }
          catch(SoapFault $fault) {
              echo '<br>'.$fault;
          }
          return view('formulario',compact('result'));

    }




/**
* Funcion para enviar  y crear la transaccion
 * author: Diego Duran
 * version: 1
 * since : 8/04/2018
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


      
                           
     ////instanciar clase persona con el constructor  
   $person = new Person($request->get('documentoPersona'),
                         $request->get('tipoDocumento'),
                         $request->get('firstName'),
                         $request->get('lastName'),
                         $request->get('company'),
                         $request->get('emailAddress'),
                         $request->get('address'),
                         $request->get('city'),
                         $request->get('province'),
                         $request->get('country'),
                         $request->get('phone'),
                         $request->get('mobile')
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
     $params = array( 'auth' => $auth   ,'transaction' =>   $PSETransactionRequest);
   //  dd($params);
     $client = $this->obtenerClienteSOAP();
     
 
      try{
              $result = $client->createTransaction($params);
         }
          catch(SoapFault $fault) {
              echo '<br>'.$fault;
          }

   ///  dd($result);
   
    $result = json_encode($result,true);
    $result = json_decode( $result, true );



  /////guardar el id de las transaccion en la base de datos 
   $transactionID = $result['createTransactionResult']['transactionID']; 

   $transactionInformation =array(
                                   'transactionID'=>$transactionID
                                );
   
   Transaction::create($transactionInformation);


   return redirect()->route('listarTransacciones');
   

  }



/**
* Funcion para listar transacciones
 * author: Diego Duran
 * version: 1
 * since : 9/04/2018
 * param : none
 * return : Lista de transacciones a la vista
 *version : 1
 */
  public function listarTransacciones(){
    /////retornar vista con lista de transacciones empaquetadas
   $transactions = Transaction::orderBy('id', 'DESC')->paginate();
   return view('lista', compact('transactions'));
   }



/**
* Funcion para obtener informacion de las transacciones
 * author: Ing. Diego Duran
 * version: 1
 * since : 9/04/2018
 * param : $
 * return : Informacion de la  transaccion en particular a la vista
 *version : 1
 */

public function obtenerTransaccion($transactionID){
   ///obtener informacion desde el servicio
     $auth = $this->obtenerArrayAutenticacion();
     $params = array( 'auth' => $auth   ,'transactionID' => $transactionID);
   //  dd($params);
     $client = $this->obtenerClienteSOAP();
    
      try{
              $result = $client->getTransactionInformation($params);
         }
          catch(SoapFault $fault) {
              echo '<br>'.$fault;
          }

 return view('verDetalles',compact('result'));

}




    
}
