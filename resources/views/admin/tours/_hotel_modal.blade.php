    <div id="hotelModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="lato-300 danger text-center">Escoge un hotel de la lista</h2>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => 'admin/tours/hotel/search',null,'class' => 'form-horizontal',
                                        'id' => 'search_form']) !!}
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group{{ $errors->has('destino') ? ' has-error' : '' }}">
                                    <div class="col-md-4 control-label">
                                        {!! Form::label('destino','Destino') !!}
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <span class="fa fa-map-marker"></span>
                                            </div> 
                                                {!! Form::select('destino',
                                                                  $destinos,
                                                                  old('destino'), 
                                                                  ['class' => 'form-control',
                                                                      'id' =>'destino',
                                                                      'onchange' => 'setZones()']) 
                                                !!} 
                                        </div>
                                        @if ($errors->has('destino'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('destino') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group{{ $errors->has('zona') ? ' has-error' : '' }}" >
                                    <div class="col-md-4 control-label">
                                        {!! Form::label('zona','Zona') !!}
                                    </div>
                                    <div class="col-md-8">
                                         <div class="input-group">
                                            <div class="input-group-addon">
                                                <span class="fa fa-map-marker"></span>
                                            </div> 
                                            {!! Form::select('zona',
                                                             ['Todas las zonas'],
                                                             old('zona'), 
                                                             ['class' => 'form-control','id' => 'zona'])
                                            !!} 
                                        </div>
                                        @if ($errors->has('zona'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('zona') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>                          
                            </div>
                             <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary"  id="searchHotel">
                                        <i class="fa fa-btn fa-search"></i>Busca
                                    </button>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-default" data-dismiss="modal" >
                    <span class="fa fa-close"></span>Cerrar</button>
            </div>
        </div>
    </div>