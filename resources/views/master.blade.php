<!DOCTYPE html>
<html lang="en">
    <head>
	    <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content=" @yield('meta_description') ">
	    <meta name="google-signin-client_id" content="@yield('google_profile_id')">
		<title>@yield('title')</title>				
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
		@yield('customcss')
		@yield('customjs')	
    </head>
	<body>
		@yield('preloader')
	    <nav class="container header navbar">
		    <div class="row">
		    	<div class="col-md-3 col-lg-3 col-xs-12 logo">		
		    		<a class="navbar-brand" href="{{ url('/') }}">
		    		    <img src="{{ asset('images/logoviaggi2.png') }}" /></a>
		    		<div class="navbar-header">
			            <button type="button" class="navbar-toggle" data-toggle="collapse"
			                    data-target="#mainNavbar">
			                <span class="fa fa-bars"></span>
			            </button>
			            <button class="navbar-toggle" data-toggle="collapse"
			                    data-target="#socialNavbar">
			            	<span class="fa fa-share-alt"></span>
			            </button>					            
			        </div>
		    	</div>

		    	<div class="col-md-9 col-lg-9 col-xs-12">		    	       		
				    <div class="collapse navbar-collapse" id="socialNavbar">
				    	<ul class="nav navbar-nav navbar-right mobile">
				    		<li id="status">
				    			@if (Auth::user() && Auth::check())	
				    		        <a href="#">
				    		        	<span class="fa fa-male"></span> {{ ucfirst(Auth::user()->name) }}
				    		        </a>
				    		    @endif
				    		</li>
				            <li><a href="#"><span class="fa fa-twitter"></span></a></li>
				            <li><a href="#"><span class="fa fa-facebook"></span></a></li>
				            <li><a href="#"><span class="fa fa-pinterest"></span></a></li> 
				            <li><a href="#"><span class="fa fa-google"></span></a></li>
				            <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
				            <li><a href="#"><span class="fa fa-skype"></span></a></li>
			            </ul>
				    </div>
                    
	                <nav class="navbar">
					    <div class="container-fluid">
					        
						    <div class="collapse navbar-collapse" id="mainNavbar">
						        <ul class="nav navbar-nav navbar-right">
						            <li @yield('inicio')><a href="{{ url('/') }}">
						            	<span class="fa fa-home"></span>Inicio</a>
						            </li>
						            <li @yield('tours')>
						            	<a href="{{ url('/tour/all') }}">
						            	    <span class="fa fa-circle-o"></span>
						            	    Tours</a>
						            </li>
						            <li @yield('hotel')><a href="{{ url('/hotel/search') }}">
						            	<span class="fa fa-hotel"></span>Hotel
						            </a></li> 
						            <li @yield('contact')><a href="{{ url('contact') }}">
						            	<span class="fa fa-envelope"></span>Contact
						            </a></li> 
						            @if (Auth::user() && Auth::check())						                
						                <li><a href="{{ url('/auth/logout') }}">
						                	<span class="fa fa-user"></span> Logout
						                </a></li>
						                @if (Auth::user()->email === 'locnetarganda@gmail.com')
						                    <li><a href="{{ url('/admin') }}">
						                	    <span class="fa fa-cog"></span> Admin
						                    </a></li>
						                @endif
						            @else
						                <li><a href="{{ url('/auth') }}">
						                	<span class="fa fa-user"></span> Login
						                </a></li>
						            @endif
						        </ul>
						    </div>
					    </div>
					</nav>

		    	</div>		    	
			</div>
		</nav>		 
					
		@yield('content')
		
	    <footer>
	    	<div class="container">
	    		<div class="row">
					<div class="col-md-4 col-xs-12">
						<h3 class="lato-300 text-center">Boletin de noticias</h3>
						<h4 class="lato-300 text-center blue">¿Quieres recibir todas nuestras ofertas?

						</h4>
						<h4 class="text-center">
							<a href="{{ url('newsletter') }}">
								<button class="btn btn-primary">
									<span class="fa fa-send"></span>¿Vamos?
								</button>
							</a>
						</h4>
					</div>
					<div class="col-md-4 col-xs-12">
						<h3 class="lato-300 text-center">Siguenos en las redes</h3>
	                    <div class="col-md-2 col-xs-2 text-center">
	                    	<h3><a href="#"><span class="fa fa-twitter"></span></a></h3>
	                    </div>
	                    <div class="col-md-2 col-xs-2 text-center">
	                    	<h3><a href="#"><span class="fa fa-facebook"></span></a></h3>
	                    </div>
	                    <div class="col-md-2 col-xs-2 text-center">
	                    	<h3><a href="#"><span class="fa fa-pinterest"></span></a></h3>
	                    </div>
		                <div class="col-md-2 col-xs-2 text-center">
	                    	<h3><a href="#"><span class="fa fa-google"></span></a></h3>
	                    </div>   
		                <div class="col-md-2 col-xs-2 text-center">
	                    	<h3><a href="#"><span class="fa fa-linkedin"></span></a></h3>
	                    </div>
	                    <div class="col-md-2 col-xs-2 text-center">
	                    	<h3><a href="#"><span class="fa fa-skype"></span></a></h3>
	                    </div> 
					</div>
					<div class="col-md-4 col-xs-12">
						<h3 class="lato-300 text-center">Contacto</h3>
						<h4 class="lato-300 blue text-center">Calle Arrebolado Nº 7 3º A </br>
							29009, Malaga, España
						</h4>
						<h4 class="lato-300 blue text-center">Tlf. +34 951 380 450 </br>
							Fax +34 951380 450 </br>
							Movil +34 664 648 197</h4>
					</div>
				</div>
		    </div>
	    </footer>		    
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	    @yield('customjs')
	</body>
</html>