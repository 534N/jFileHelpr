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
<style>
.span4 {
	width: 298px;
	text-align: center;
}
.well {
	padding: 60px 0px 20px 0px !important;
}
.span4 > .well > div > a > i {
	font-size: 200px;

}
.span4 > .well > div:last-child {
	margin-top: 60px;
}
a {
	color: #323232;
}
a:hover {
	text-decoration: none;
}
</style>
<ul class="breadcrumb">
	<li class="active">Admin Panel</li>
</ul>
<div class="row">
	<div class="span4">
		<div class="well">
			<div><a href="{{ URL::to('admin/users') }}"><i class="icon-group"></i></a></div>
			<div>Admin Users</div>
		</div>
	</div>

</div>
@endsection