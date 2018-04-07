<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>


<body>
    <div id="app">
        <!--barra navegacion -->
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                      <a class="navbar-brand">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                          
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                        
                        </ul>
                    </div>
                </div>
            </nav>

  <!--contenedor -->
        <div class="container">
              <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               SELECCIONAR BANCO
                            </div>
                            <div class="panel-body">
                            {!! Form::open(['route' => 'crearTransaccion.store']) !!}
                             <div class="form-group"> 
                                 <label for="selectBanco">Lista de Bancos</label>
                                  <select  id="idBanco" name="idBanco" class="form-control" id="sel1">
                                      @foreach( $result->getBankListResult->item as $item)
                                         <option value="{{ $item->bankCode }}"> {{  $item->bankName }}</option>
                                   @endforeach 
                                   </select>
                              </div>       
                             <div class="form-group">
                                 {{ Form::label('descripcionPago','Descripcion Pago') }}
                                 {{ Form::textarea('descripcionPago', null, ['class' => 'form-control','rows'=>'2']) }}
                             </div>
                             <div class="form-group">
                                {{ Form::label('totalCantidad', 'Total Cantidad') }}
                                {{ Form::number('totalCantidad', null, ['class' => 'form-control', 'id' => 'totalCantidad','max' => 100000 ]) }}
                             </div>   
                             <div class="form-group">
                                {{ Form::label('impuesto', 'Impuesto') }}
                                {{ Form::number('impuesto', null, ['class' => 'form-control', 'id' => 'impuesto','max' => 100000]) }}
                             </div>  
                             <div class="form-group">
                                {{ Form::label('devolucionBase', 'Devolucion Base') }}
                                {{ Form::number('devolucionBase', null, ['class' => 'form-control', 'id' => 'devolucionBase','max' => 100000]) }}
                             </div>  
                              <div class="form-group">
                                {{ Form::label('propina', 'Propina') }}
                                {{ Form::number('propina', null, ['class' => 'form-control', 'id' => 'propina','max' => 100000]) }}
                             </div>  
                              <div class="form-group">
                                {{ Form::label('documentoPersona', 'Documento Persona') }}
                                {{ Form::text('documentoPersona', null, ['class' => 'form-control', 'id' => 'documentoPersona']) }}
                             </div>  
                             <div class="form-group">
                                {{ Form::label('tipoDocumento', 'Tipo Documento') }}
                                {{ Form::select('tipoDocumento', ['CC' => 'Cedula Ciudadania','CE' => 'Cedula Extranjeria' , 'TI' => 'Tarjeta Identidad', 'PNP' => 'Pasaporte'], 'CC',['class' => 'form-control', 'id' => 'tipoDocumento']) }}
                             </div>  

                             <div class="form-group">
                                {{ Form::label('firstName', 'Primer Nombre') }}
                                {{ Form::text('firstName', null, ['class' => 'form-control', 'id' => 'firstName']) }}
                             </div>  
                              <div class="form-group">
                                {{ Form::label('lastName', 'Apellidos') }}
                                {{ Form::text('lastName', null, ['class' => 'form-control', 'id' => 'lastName']) }}
                             </div>  
                              <div class="form-group">
                                {{ Form::label('company', 'Empresa') }}
                                {{ Form::text('company', null, ['class' => 'form-control', 'id' => 'company']) }}
                             </div>  
                              <div class="form-group">
                                {{ Form::label('emailAddress', 'Correo Electronico') }}
                                {{ Form::email('emailAddress', null, ['class' => 'form-control', 'id' => 'emailAddress']) }}
                             </div>  
                              <div class="form-group">
                                {{ Form::label('address', 'Direccion') }}
                                {{ Form::text('address', null, ['class' => 'form-control', 'id' => 'address']) }}
                             </div>
                              <div class="form-group">
                                {{ Form::label('city', 'Ciudad ') }}
                                {{ Form::text('city', null, ['class' => 'form-control', 'id' => 'city']) }}
                             </div>    
                              <div class="form-group">
                                {{ Form::label('province', 'Provincia ') }}
                                {{ Form::text('province', null, ['class' => 'form-control', 'id' => 'province']) }}
                             </div>  
                              <div class="form-group">
                                {{ Form::label('country', 'Pais') }}
                                {{ Form::text('country', null, ['class' => 'form-control', 'id' => 'country']) }}
                             </div>  
                              <div class="form-group">
                                {{ Form::label('phone', 'Telefono') }}
                                {{ Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone']) }}
                             </div>  
                              <div class="form-group">
                                {{ Form::label('mobile', 'Celular') }}
                                {{ Form::text('mobile', null, ['class' => 'form-control', 'id' => 'mobile']) }}
                             </div>  
                            

                            <div class="form-group">
                                 {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
                            </div>
                                 {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
              </div>
        </div> 
 </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
   
</body>
</html>



