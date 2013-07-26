@layout('layouts.default')

@section('title') 
	{{ Config::get('site.name') }}
@endsection

@section('navigation')
	{{ View::make('layouts.nav') }}
@endsection

@section('content') 
	
	
	<div class="contents">
		<!-- your page contents -->
		<div class="row-fluid" style="background: #fff;">
			<div class="row-fluid intro_1_wrapper offset1">
				<h1 class="welcome-head"><a href="files/{{ Auth::user()->id }}">Get Started</a> </h1>
			</div>
			<div>
				THIS IS THE HOME PAGE, YOU CAN ADD YOUR STUFF HERE...
			</div>
		</div>
	</div>
	
@endsection
