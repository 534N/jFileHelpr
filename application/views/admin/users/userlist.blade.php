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
<ul class="breadcrumb">
	<li>{{ HTML::link('admin', 'Admin panel') }} <span class="divider">&raquo;</span></li>
	<li class="active">Users</li>
</ul>
<div id="userlist">
	<legend>User list</legend>
	<table class="table table-bordered table-hover table-condensed table-striped">
		<tbody>
		@foreach ($users as $user)
		<tr>
			<td>
				<span>{{ $user->username }}</span>
			</td>
			<td class="user-options">
				<div class="input-prepend input-append">
					{{ HTML::link('admin/user/'.$user->id,'', array('class' => 'btn append icon-edit')) }}
				</div>
			</td>
		</tr>
		@endforeach
		<tr>
			<td colspan="2" class="user-new">
				<a href="{{ URL::to('admin/user/new') }}" class="icon icon-plus"> Create new user</a>
			</td>
		</tr>
		</tbody>
	</table>
</div>
@endsection