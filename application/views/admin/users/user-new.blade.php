@layout('layouts/default')

@section('title') 
	{{ Config::get('site.name') }}
@endsection

@section('navigation')
	{{ View::make('layouts.nav') }}
@endsection

@section('css')
	{{ HTML::style('css/admin.css') }}
@endsection

@section('content')

@if(isset($alert))
<div class="alert <?= $alert ?>">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ $alert_message }}
	{{ implode('', $errors->all('<p>:message</p>')) }}
</div>
@endif
<ul class="breadcrumb">
	<li>{{ HTML::link('admin', 'Admin Panel') }} <span class="divider">&raquo;</span></li>
	<li>{{ HTML::link('admin/users', 'Users') }} <span class="divider">&raquo;</span></li>
	<li class="active">New</li>
</ul>
<ul class="nav nav-tabs">
	<li class="active">{{ HTML::link('#', 'General') }}</li>
	<li>{{ HTML::link('#', 'Files', array('class' => 'disabled')) }}</li>
</ul>
<div class="tab-content">
	<div class="tab-pane active form clearfix" id="course-info">
		<div class="form">
			<legend>New User</legend>
			{{ Form::open() }}
			@if ($errors->has('username'))
				<div class="field control-group error">
			@else 
				<div class="field control-group">
			@endif
				{{ Form::label('username', 'Username') }}
				{{ Form::text('username', Input::old('username')) }}
			</div>
			<div class="pull-right">
				{{ HTML::link('admin/users', 'Cancel', array('class' => 'btn')) }}
				{{ Form::submit('Create', array('class' => 'btn btn-success')) }}
			</div>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
</div>
@endsection