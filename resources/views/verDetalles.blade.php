@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista Transacciones
                </div>

                <div class="panel-body">
                <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">Nombre</th>
                                <th>Valor</th>
                            </tr>    
                       </thead>
                        <tbody>
                            @foreach( $result as $item)
                            <tr>
                                <td>TransactionID</td>
                                <td>{{ $item->transactionID}}</td>
                             </tr>
                              <tr>
                                <td>sessionID</td>
                                <td>{{ $item->sessionID}}</td>
                             </tr>
                              <tr>
                                <td>reference</td>
                                <td>{{ $item->reference}}</td>
                             </tr>
                              <tr>
                                <td>requestDate</td>
                                <td>{{ $item->requestDate}}</td>
                             </tr>
                              <tr>
                                <td>bankProcessDate</td>
                                <td>{{ $item->bankProcessDate}}</td>
                             </tr>
                              <tr>
                                <td>onTest</td>
                                <td>{{ $item->onTest}}</td>
                             </tr>
                              <tr>
                                <td>returnCode</td>
                                <td>{{ $item->returnCode}}</td>
                             </tr>
                              <tr>
                                <td>trazabilityCode</td>
                                <td>{{ $item->trazabilityCode}}</td>
                             </tr>
                              <tr>
                                <td>transactionCycle</td>
                                <td>{{ $item->transactionCycle}}</td>
                             </tr>
                              <tr>
                                <td>transactionState</td>
                                <td>{{ $item->transactionState}}</td>
                             </tr>
                              <tr>
                                <td>responseCode</td>
                                <td>{{ $item->responseCode}}</td>
                             </tr>
                              <tr>
                                <td>responseReasonCode</td>
                                <td>{{ $item->responseReasonCode}}</td>
                             </tr>
                              <tr>
                                <td>responseReasonText</td>
                                <td>{{ $item->responseReasonText}}</td>
                             </tr>




                            @endforeach
                        </tbody>   
                    </table>        
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection