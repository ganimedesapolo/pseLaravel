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
                
      {{--     /*            +"transactionID": 1456777410
    +"sessionID": "52d22b34afdbcfe9c09803781a301dbf"
    +"reference": "sdertertrt465etgt4tttr"
    +"requestDate": "2018-04-09T11:10:40-05:00"
    +"bankProcessDate": "2018-04-09T11:52:06-05:00"
    +"onTest": true
    +"returnCode": "SUCCESS"
    +"trazabilityCode": "1410482"
    +"transactionCycle": -1
    +"transactionState": "NOT_AUTHORIZED"
    +"responseCode": 2
    +"responseReasonCode": "01"
    +"responseReasonText": "Rechazada"  */ --}}
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
                            @endforeach
                        </tbody>   
                    </table>        
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection