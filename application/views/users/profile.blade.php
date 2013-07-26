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
    {{ HTML::style('css/jquery.treeview.css') }}
@endsection

@section('js-header')
	{{ HTML::script('js/jquery-1.8.0.min.js') }}
@endsection

@section('content')
	<script type="text/javascript">
		$(function() {
			$('#ruleForm').submit(function(event) {
				event.preventDefault();
				$.ajax({
					url: "ruler/index",
					success: function(response) {
						$('#result').html(response);
						$('head').append('<script src="js/jquery.treeview.js" />');
						$('#ruleResult').treeview({
							collapsed: true,
							animated: 'fast',
							control:'#sidetreecontrol',
							prerendered: true,
							persist: 'location'
						});
					}
				});
			});
		});
	</script>

	{{ Form::open('parser/insert') }}
	{{ Form::submit('Decode', array('class'=>'btn btn-primary')) }} 

	{{ Form::token() }}
	{{ Form::close() }}

	{{ Form::open('ruler/index', 'POST', array('id' => 'ruleForm')) }}
	{{ Form::submit('Rule', array('class'=>'btn btn-primary')) }} 

	{{ Form::token() }}
	{{ Form::close() }}

	<a class="a_demo_four">Click Me</a>

	<div id='result'></div>
@endsection