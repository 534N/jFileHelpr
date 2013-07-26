<!DOCTYPEHTML>
<meta http-equiv="X-UA-Complatible" content="IE=8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html> 
<head>
	<title>@yield('title')</title> 
	<link href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold" rel="stylesheet">
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/bootstrap-responsive.css') }}
	{{ HTML::style('font/webfonts/ss-pika.css') }}
	{{ HTML::style('css/demo.css') }}

	@if(preg_match('/MSIE/',$_SERVER['HTTP_USER_AGENT']))
        {{ HTML::style('css/font-awesome-ie7.css') }}
    @else
    	{{ HTML::style('css/font-awesome.css') }}
	@endif

	{{ HTML::style('bundles/jfileupload/css/jquery.fileupload-ui.css') }}
	{{ HTML::style('css/bootstrap.override.css') }}
	{{ HTML::style('css/admin.css') }}
	{{ HTML::style('css/myStyle.css') }}
    
    {{ HTML::script('js/jquery-1.8.0.min.js') }}
    {{ HTML::script('js/nav.js')}}
    {{ HTML::script('js/meny.min.js')}}

	@yield('css')
	@yield('js-header')
</head>
<body>
	<div class="row-fluid">
		@yield('navigation')

		@yield('content')
		@yield('welcome')
		@yield('help')


		<footer class="footer-copyright span12">
			@yield('footer')
		</footer>
	</div>
</body>


{{ HTML::script('js/jquery-1.8.0.min.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/nav.js') }}

@yield('js-footer')
</html>