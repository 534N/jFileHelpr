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
    {{ HTML::style('css/myStyle.css') }}
@endsection

@section('content')
	<div class="auth-panel">
		<div style="padding: 30px;">
			{{ Form::open('portal/create', 'POST')  }}

			@if ($errors->has())
				<ul>
					{{ $errors->first('firstname', '<li>:message</li>') }}
					{{ $errors->first('lastname', '<li>:message</li>') }}
					{{ $errors->first('customer', '<li>:message</li>') }}
					{{ $errors->first('username', '<li>:message</li>') }}
					{{ $errors->first('password', '<li>:message</li>') }}
				</ul>
			@endif

			<p>
				{{ Form::label('firstname', 'First Name:') }}
				{{ Form::text('firstname', Input::old('firstname')) }}
			</p>

			<p>
				{{ Form::label('lastname', 'Last Name:') }}
				{{ Form::text('lastname', Input::old('lastname')) }}
			</p>

			<p>
				{{ Form::label('customer', 'Customer:') }}
				{{ Form::text('customer', Input::old('customer')) }}
			</p>

			<p>
				{{ Form::label('username', 'User Name:') }}
				{{ Form::text('username', Input::old('username')) }}
			</p>

			<p>
				{{ Form::label('password', 'Password:') }}
				{{ Form::password('password') }}
			</p>
			<BR>
			<p>{{ Form::submit('Register', array('class'=>'btn btn-primary btn-flat')) }}</p>

			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
@endsection

@section('footer')
    {{ View::make('layouts.footer') }}
@endsection