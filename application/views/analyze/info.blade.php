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
    <li class="active">{{ HTML::link('#', 'System Summary') }}</li>
    <li>{{ HTML::link('more/'.$user_id.'/'.$filename, 'More') }}</li>
</ul>

<script type="text/javascript">
    disk_data = <?php echo preg_replace('/[^(\x20-\x7F)]*/','', json_encode($pie)); ?>;

    $(function() {
        $('#analyze-info').tabs();

        setTimeout(function() {
            var iframe = $(parent.document.getElementById('load-div'));
            console.log(iframe);
            container_height = iframe.context.contentWindow.document.body.children[0].clientHeight;
            console.log(container_height);
            iframe.css('height', container_height + 'px');  
        }, 1000);

    });
</script>
{{ HTML::script('js/cpu_pie.js') }}

<div id="analyze-info">
    <div class="nav-sub-fixed "> 
        <ul class="nav nav-pills offset1">
            <li><a href="#summary">System Dashboard</a></li>
        </ul>
    </div>

    <div class="nav-content">
        <div id="summary" class="span11 offset1">
            <p class="summary span3">
            @foreach ($summary as $key => $value)
                <B>{{$key}}</B> &nbsp; {{$value}} <BR>
            @endforeach
            </p>
            <div id="chart_div" class="span4"></div>
        </div>
    </div>
</div>
@endsection

