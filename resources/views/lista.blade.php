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
                                <th width="10px">Numero</th>
                                <th>ID Transaccion</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->id }}</td>
                                <td>{{ $transaction->transactionID }}</td>
                                <td width="10px">
                                    <a href="" class="btn btn-sm btn-default">Ver</a>
                                </td>
                                <td width="10px">
                                    <a href="" class="btn btn-sm btn-default">Editar</a>
                                </td>
                                <td width="10px"></td>
                            </tr>
                            @endforeach
                        </tbody>   
                    </table>        

                    {{ $transactions->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection