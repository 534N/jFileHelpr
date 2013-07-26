<!DOCTYPEHTML>
<html> 
<head>
	
	<link href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold" rel="stylesheet">
	
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/bootstrap-responsive.css') }}
	@if(preg_match('/MSIE/',$_SERVER['HTTP_USER_AGENT']))
        {{ HTML::style('css/font-awesome-ie7.css') }}
    @else
    	{{ HTML::style('css/font-awesome.css') }}
	@endif
	{{ HTML::style('css/jquery.treeview.css') }}
	{{ HTML::style('css/jquery-ui.css') }}
    {{ HTML::style('bundles/jfileupload/css/bootstrap-image-gallery.min.css') }}
    {{ HTML::style('bundles/jfileupload/css/jquery.fileupload-ui.css') }}
	{{ HTML::style('css/bootstrap.override.css') }}
	{{ HTML::style('css/myStyle.css') }}
    {{ HTML::style('css/admin.css') }}
    {{ HTML::style('font/webfonts/ss-pika.css') }}

    {{ HTML::script('js/jquery-1.8.0.min.js') }}
    {{ HTML::script('js/jquery.treeview.js') }}
    {{ HTML::script('js/nav.js') }}
    {{ HTML::script('js/jquery-ui.js') }}

	@yield('css')
	@yield('js-header')
</head>
<body style="overflow-x: hidden">
	<div class="container row-fluid">
		@if (Session::has('message'))
			<div class="alert alert-error" >{{ Session::get('message') }}</div>
		@endif
		
		@yield('content')
	</div>
</body>

</html>