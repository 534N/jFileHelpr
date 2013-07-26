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
@if(Session::get('alert'))
<div class="alert <?= Session::get('alert') ?>">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ Session::get('alert_message') }}
</div>
@endif
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
    <li>{{ HTML::link('admin/user/'.$user->id, $user->username) }} <span class="divider">&raquo;</span></li>
    <li class="active">Delete</li>
</ul>
<ul class="nav nav-tabs">
	<li class="active">{{ HTML::link('#', 'General') }}</li>
	<li>{{ HTML::link('admin/user/'.$user->id.'/files', 'Files') }}</li>
	<li>{{ HTML::link('admin/user/'.$user->id.'/delete', 'Delete') }}</li>
</ul>
<div class="tab-content">
	<div class="tab-pane active form clearfix">
		<div class="form">
			<legend>New User</legend>
			{{ Form::open('admin/user/'.$user->id.'/general') }}
			@if ($errors->has('username'))
				<div class="field control-group error">
			@else 
				<div class="field control-group">
			@endif
				{{ Form::label('username', 'Username') }}
				{{ Form::text('username', input_value($user->username,Input::old('username'))) }}
			</div>
			<div class="pull-right">
				{{ HTML::link('admin/users', 'Cancel', array('class' => 'btn')) }}
				{{ Form::submit('Update', array('class' => 'btn btn-success')) }}
			</div>
			{{ Form::token() }}
			{{ Form::close() }}
		</div>
	</div>
</div>

@endsection