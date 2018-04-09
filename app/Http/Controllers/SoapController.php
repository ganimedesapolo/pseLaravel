<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Conexion;
use App\Transaction;

class SoapController 
{

   



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
    
      $client = Conexion::obtenerClienteSOAP();
      $atentificacion = Conexion::obtenerArrayAutenticacion();
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
   
   ///algunos datos en codigo duro ("quemado"), pero se puede implementar mediante el llamado al constructor de una 
  //clase, como por ejemplo la clase Person, pero debido a la naturaleza del problema se realizo asi para algunos campos


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


     $auth = Conexion::obtenerArrayAutenticacion();
     $params = array( 'auth' => $auth   ,'transaction' =>   $PSETransactionRequest);
   //  dd($params);
     $client = Conexion::obtenerClienteSOAP();
     
 
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
     $auth = Conexion::obtenerArrayAutenticacion();
     $params = array( 'auth' => $auth   ,'transactionID' => $transactionID);
   //  dd($params);
     $client = Conexion::obtenerClienteSOAP();
    
      try{
              $result = $client->getTransactionInformation($params);
         }
          catch(SoapFault $fault) {
              echo '<br>'.$fault;
          }

 return view('verDetalles',compact('result'));

}




    
}
