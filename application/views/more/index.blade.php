@layout('layouts.fancy')

@section('css')
    {{ HTML::style('css/complete.css') }}
@endsection

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<style id="pseudo"></style>

@section('content')

@if(isset($alert))
<div class="alert <?= $alert ?>">
    <button type="button" class="close" data-dismiss="alert">Ã—</button>
    {{ $alert_message }}
</div>
@endif

<ul class="nav nav-tabs nav-fixed span12 offset1">
    <li>{{ HTML::link('analyze/'.$user_id.'/'.$filename, 'System Summary') }}</li>
    <li class="active">{{ HTML::link('#', 'More') }}</li>
</ul>

<script type="text/javascript">
    $(function() {
        $('#more-info').tabs();

        setTimeout(function() {
            var iframe = $(parent.document.getElementById('load-div'));
            console.log(iframe);
            container_height = iframe.context.contentWindow.document.body.children[0].clientHeight;
            console.log(container_height);
            iframe.css('height', container_height + 'px');  
        }, 1000);
    });
</script>

<div id="more-info">
    <div class="nav-sub-fixed "> 
        <ul class="nav nav-pills offset1">
            <li><a href="#tab1">Tab1</a></li>
            <li><a href="#tab2">Tab2</a></li>
        </ul>
    </div>

    <div class="nav-content">
        <div id="tab1" class="span11 offset1">
        	Tab1 content here...
        </div>
        <div id="tab2" class="span11 offset1">
        	Tab2 content here...
        </div>
    </div>
</div>
@endsection