        
        <div class="row">
	        <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
	        	<div class="col-md-3 control-label">
	        		{!! Form::label('titulo', 'Denumire tour:', array('class' => 'control-label')) !!}
	        	</div>
	        	<div class="col-md-9 col-xs-12">
	        		{!! Form::text('titulo', old('titulo'),
	        		          [ 'class' => 'form-control']) !!}
	        		{!! $errors->first('titulo', '<span class="help-block">:message</span>') !!}
	        	</div>	        	
		    </div>
		</div>
	    <div class="row">
		    <div class="form-group{{ $errors->has('destino') ? ' has-error' : '' }}">
		    	<div class="col-md-3 control-label">
		    	    {!! Form::label('destino', 'Destino: ', array('class' => 'control-label')) !!}
		    	</div>
		    	<div class="col-md-3 col-xs-12">
		    		{!! Form::select('destino', $destinos, old('destinos'), ['class' => 'form-control']) !!}
		    		{!! $errors->first('destino', '<span class="help-block">:message</span>') !!}
		    	</div>		    	
		    </div>
		</div>
		<div class="row">
		     <div class="form-group{{ $errors->has('visibility') ? ' has-error' : '' }}">
		     	<div class="col-md-3 col-xs-9 control-label">
		     		{!! Form::label('visibility', 'Visibile en portada:', array('class' => 'control-label')) !!}
		     	</div>
		     	<div class="col-md-9 col-xs-3">
		    	    {!! Form::checkbox('visibility', old('visibility'), ['class' => 'form-control pull-right']) !!}
		    	</div>
		    </div>
		</div>
		<div class="row">
		    <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
		        <div class="col-md-3 col-xs-12 control-label">
		            <p> {!! Form::label('descripcion', 'Descripcion:', array('class' => 'control-label')) !!}</p>
		        </div>
		        <div class="col-md-9 col-xs-12">
		    	    <p> {!! Form::textarea('descripcion', old('descripcion'),
		    	         ['class' => 'form-control']) !!} </p>
		    	</div>
		    </div>
		</div>
		<div class="row">
		     <div class="form-group {{ $errors->has('start') ? 'has-error' : '' }}">
		     	<div class="col-md-3 col-xs-6">
	        	    <p>{!! Form::label('start', 'Fecha inicio:', array('class' => 'control-label')) !!} </p>
	        	</div>
	        	<div class="col-md-3 col-xs-6">
	        	    {!! Form::text('start', null, [ 'class' => 'form-control']) !!}
	        	    {!! $errors->first('start', '<span class="help-block">:message</span>') !!}
	        	</div>
	        </div>
	    </div>
	    <div class="row">
	    	<div class="form-group {{ $errors->has('fin') ? 'has-error' : '' }}">
	        	<div class="col-md-3 col-xs-6">
	        		<p>{!! Form::label('fin', 'Fecha fin:', array('class' => 'control-label')) !!} </p>
	        	</div>
	        	<div class="col-md-3 col-xs-6">
	        		{!! Form::text('fin', null, [ 'class' => 'form-control']) !!}
	        		{!! $errors->first('fin', '<span class="help-block">:message</span>') !!}
	        	</div>	        	
		    </div>
		</div>
		<div class="row">
	    	<div class="form-group {{ $errors->has('dias') ? 'has-error' : '' }}">
	        	<div class="col-md-3 col-xs-6">
	        		<p>{!! Form::label('dias', 'Dias del tour:', array('class' => 'control-label')) !!} </p>
	        	</div>
	        	<div class="col-md-3 col-xs-6">
	        		{!! Form::text('dias', null, [ 'class' => 'form-control']) !!}
	        		{!! $errors->first('dias', '<span class="help-block">:message</span>') !!}
	        	</div>	        	
		    </div>
		</div>
		<div class="row">
	    	<div class="form-group {{ $errors->has('hoteles') ? 'has-error' : '' }}">
	        	<div class="col-md-3 col-xs-9">
	        		<p>{!! Form::label('hoteles', 'Numero de hoteles:', array('class' => 'control-label')) !!} </p>
	        	</div>
	        	<div class="col-md-3 col-xs-3">
	        		{!! Form::text('hoteles', null, [ 'class' => 'form-control']) !!}
	        		{!! $errors->first('hoteles', '<span class="help-block">:message</span>') !!}
	        	</div>	        	
		    </div>
		</div>
		