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
</div>
@endif
<ul class="breadcrumb">
    <li>{{ HTML::link('admin', 'Admin Panel') }} <span class="divider">&raquo;</span></li>
    <li>{{ HTML::link('admin/users', 'Users') }} <span class="divider">&raquo;</span></li>
    <li>{{ HTML::link('admin/user/'.$user->id, $user->username) }} <span class="divider">&raquo;</span></li>
    <li class="active">Delete</li>
</ul>
<ul class="nav nav-tabs">
	<li>{{ HTML::link('admin/user/'.$user->id, 'General') }}</li>
	<li>{{ HTML::link('admin/user/'.$user->id.'/files', 'Files') }}</li>
	<li class="active">{{ HTML::link('#', 'Delete') }}</li>
</ul>
<div class="tab-content">
	<div class="tab-pane active form" id="delete-info">
		<legend>Delete user</legend>
		{{ Form::open('admin/user/'.$user->id.'/delete','POST',array('class' => 'form-horizontal')) }}
		@if ($errors->has('delete'))
		<div class="field control-group error" style="margin: 0px;">
		@else 
		<div class="field control-group" style="margin: 0px;">
		@endif
		{{ Form::label('delete', 'Write "I AGREE" in order to delete the user') }}
		</div>
		<div class="input-append">
			{{ Form::text('delete', Input::old('delete'), array('id' => 'delete','style' => 'width: 730px')) }}
			{{ Form::submit('Delete user', array('class' => 'btn btn-danger append','style' => 'width: 140px;')) }}
		</div>
		{{ Form::token() }}
		{{ Form::close() }}
	</div>
</div>
@endsection