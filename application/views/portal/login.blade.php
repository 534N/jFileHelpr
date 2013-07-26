@layout('layouts.default')

@section('title') 
	{{ Config::get('site.name') }}
@endsection

@section('navigation')
	{{ View::make('layouts.nav') }}
@endsection

@section('css')
	{{ HTML::style('css/admin.css') }}
    {{ HTML::style('bundles/jfileupload/css/bootstrap-image-gallery.min.css') }}
    {{ HTML::style('bundles/jfileupload/css/jquery.fileupload-ui.css') }}
@endsection


@section('content')


	

	<div class="auth-panel">

	@if (Session::has('error'))
		<div class="alert alert-error ">{{ Session::get('error') }}</div>
	@endif

	@if (Session::has('message'))
		<div class="alert alert-info ">{{ Session::get('message') }}</div>
	@endif
		
	@if (Auth::check())
		<div></div>
	@else
	<div class="" style="padding: 30px;">
		{{ Form::open('portal/index')  }}

		<div>
			{{ Form::label('username', 'User Name:') }}  {{ Form::text('username') }}
		</div>
		<BR />
		<div>
			{{ Form::label('password', 'Password:') }}
			{{ Form::password('password') }}
		</div>
		<BR />

		{{ Form::submit('Login', array('class'=>'btn btn-primary btn-flat')) }} 

		{{ Form::token() }}
		{{ Form::close() }}
	</div>
	@endif
	</div>
@endsection

@section('footer')
    {{ View::make('layouts.footer') }}
@endsection