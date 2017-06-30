                            
                            <div class="col-md-12 room" id="div_for_room_{{ $roomNr }}">

                                <div class="form-group{{ $errors->has('room'.$roomNr) ? ' has-error' : '' }}">
                                    <div class="col-md-12 col-xs-12">
                                        <h3 class="lato-300 text-center">Habitacion {{ $roomNr }}</h3>
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        {!! Form::label('adult_in_room_'.$roomNr,'Adultos') !!}
                                    
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <span class="fa fa-male"></span>
                                            </div>
                                            {!! Form::select('adult_in_room_'.$roomNr, 
                                                             [1 => '1', 2 => '2', 3 => '3', 4 => '4'],1,
                                                             ['class' => 'form-control', 
                                                             'id' => 'adult_in_room_'.$roomNr]) 
                                            !!}

                                            @if ($errors->has('adult_in_room_'.$roomNr))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('adult_in_room_'.$roomNr) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        
                                    </div>                                    
                                    <div class="col-md-3 col-xs-6">                                        
                                        {!! Form::label('child_in_room_'.$roomNr,'Niños') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <span class="fa fa-child"></span>
                                            </div>
                                            {!! Form::select('child_in_room_'.$roomNr, 
                                                            [0, 1, 2],0,
                                                            ['class' => 'form-control', 
                                                            'id' => 'child_in_room_'.$roomNr,
                                                            'onchange' => 'setChildrenAge('.$roomNr.')']) 
                                            !!}

                                            @if ($errors->has('child_in_room_'.$roomNr))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('child_in_room_'.$roomNr) }}</strong>
                                                </span>
                                            @endif
                                        </div>                                                                           
                                    </div>
                                    <div class="col-md-5 col-xs-8">
                                        <div class="col-md-12" id="ages_for_room_{{ $roomNr }}">
                                            {!! Form::label('Edad niños: ') !!}
                                        </div>
                                        

                                        <div class="col-md-6 child_0">
                                            {!! Form::select('room_'.$roomNr.'_age_0', 
                                                             [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],0,
                                                             ['class' => 'form-control', 
                                                             'id' => 'room_'.$roomNr.'_age_0']) 
                                            !!}
                                        </div>

                                         <div class="col-md-6  child_1">
                                            {!! Form::select('room_'.$roomNr.'_age_1', 
                                                             [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],0,
                                                             ['class' => 'form-control', 
                                                             'id' => 'room_'.$roomNr.'_age_1']) 
                                            !!}
                                        </div>

                                    </div>
                                    <div class="col-md-1 col-xs-4 room_button"> 
                                        <button  class="btn btn-success pull-right addRoom" 
                                                 onclick="setRooms({{ $roomNr }});">                                   
                                            <span class="fa  fa-plus-circle"></span>
                                        </button>                                                                        
                                    </div> 
                                </div>
                            </div>
                        