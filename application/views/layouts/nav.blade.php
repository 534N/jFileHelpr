
<div class="navbar navbar-fixed-top span12" >
	
			<a class="brand offset1" href="{{URL::base()}}" style="padding-top: 5px; padding-bottom: 0px;">
				<img src="{{URL::base()}}/img/logo-1.png">
			</a>
			
			@if (Auth::check())
				<div class="span2" style="float: right;">
					{{ Form::open('portal/logout')  }}

						<div class="user"> 
							<span class="username">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }} </span>
							<button class="btn">
								<i class="icon-off"></i>
							</button>
						</div> 
						

					{{ Form::token() }}
					{{ Form::close() }}
					
				</div>
			@else
					
				<div class="nav offset6">
				@if(URI::segment(2) != 'register')
					{{ HTML::link_to_route('register_user', 'Register') }} 
				@else 
					{{ HTML::link_to_route('portal', 'Log In') }} 
				@endif
				</div>
			@endif


</div>