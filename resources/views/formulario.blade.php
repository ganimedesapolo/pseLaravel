 @extends('layout')
 @section('content')
  <div class="container">
              <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               SELECCIONAR BANCO
                            </div>
                            <div class="panel-body">
                            {!! Form::open(['route' => 'crearTransaccion.guardar']) !!}
                             <div class="form-group"> 
                                 <label for="selectBanco">Lista de Bancos</label>
                                  <select  id="idBanco" name="idBanco" class="form-control" id="sel1">
                                      @foreach( $result->getBankListResult->item as $item)
                                         <option value="{{ $item->bankCode }}"> {{  $item->bankName }}</option>
                                   @endforeach 
                                   </select>
                              </div>     
                           <hr><h3>Por favor digite los siguientes datos necesarios para la simulacion</h3><hr>

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
                                {{ Form::number('documentoPersona', null, ['class' => 'form-control', 'id' => 'documentoPersona']) }}
                             </div>  
                             <div class="form-group">
                                {{ Form::label('tipoDocumento', 'Tipo Documento') }}
                                {{ Form::select('tipoDocumento', ['CC' => 'Cedula Ciudadania','CE' => 'Cedula Extranjeria' , 'TI' => 'Tarjeta Identidad', 'PNP' => 'Pasaporte'], 'CC',['class' => 'form-control', 'id' => 'tipoDocumento']) }}
                             </div>  

                             <div class="form-group">
                                {{ Form::label('firstName', 'Nombres') }}
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
                                {{ Form::select('country', ['CO' => 'Colombia'], 'CO',['class' => 'form-control', 'id' => 'country']) }}
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
 @endsection