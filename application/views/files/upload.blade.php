@layout('layouts/default')

@section('title') 
    {{ Config::get('site.name') }}
@endsection


@section('navigation')
    {{ View::make('layouts.nav') }}
@endsection

@section('js-header')
    {{ HTML::script('js/bootstrap.js') }}
@endsection

    <style id="detail_arrow"></style>

@section('content')

    @if(isset($alert))
    <div class="alert <?= $alert ?>">
        <button type="button" class="close" data-dismiss="alert">Ã—</button>
        {{ $alert_message }}
    </div>
    @endif

    <script type="text/javascript">
        $(function() {
            $('.analyzeTooltip').live('mouseover', function() {
                $(this).tooltip();
            });

            $('#fileupload_instruct').live('click', function() {
                $('.fileupload-buttonbar input').trigger('click');
            });
        });
    </script>
    
    <div class="file-container row-fluid">

        {{ Form::open_for_files('files/'.$user->id.'/upload/','POST',array('id' => 'fileupload')) }}

        <div role="presentation" class="files clearfix" data-toggle="modal-gallery" data-target="#modal-gallery">

            <div class="fileupload-buttonbar hidden-phone hidden-tablet hidden-desktop">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <div class="input-prepend input-append" style="display:block;">
                    <span class="fileinput-button fileupload-button-square analyzeTooltip" data-toggle="tooltip" title="Choose a file to upload">
                        <i class="ss-plus icon-white fileinput-plus"></i>
                        <input type="file" name="files[]" multiple style="height:60px; width:60px; border: 0px; z-index:1000;">
                    </span>
                </div>

                <!-- The global progress information -->
                <div class="fileupload-progress fade" style="display:none;">
                    <!-- The global progress bar -->
                    <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                        <div class="bar" style="width:0%;"></div>
                    </div>
                    <!-- The extended global progress information -->
                    <div class="progress-extended">&nbsp;</div>
                </div>
            </div>
        </div>

        <div class="span11 welcome-intro" id="fileupload_instruct">
            <div class="welcome-icon"><i class="ss-textfile"></i></div>
            <h2>DRAG AND DROP YOUR FILES HERE TO GET STARTED</h3>
            <h3 class="light-small">ACCEPTED FILE TYPES: VALID 7X50 TECH SUPPORT FILE IN RELEASE 9.0 AND ABOVE</h2>
        </div>

        <!-- The loading indicator is shown during file processing -->
        <div class="fileupload-loading"></div>
        
        {{ Form::token() }}
        {{ Form::close() }}

        <div id="file-container-close" class="hidden-phone"><i class="icon-chevron-up"></i></div>

    </div>

    <!-- The template to display files available for upload -->
    <script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <div class="template-upload fade clearfix">
            <div class="deletecheck" style="display:none;"></div>

            <div class="ts-info-top clearfix">
                <span style="font-size: 15px; ">{%=file.name%}</span>
                <span style="color: #999999; font-size: 12px; ">({%=o.formatFileSize(file.size)%})</span>
            </div>
            <div class="ts-info-bottom clearfix">
                <div class="name clearfix"></div>
                {% if (file.error) { %}
                    <div class="error"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</div>
                {% } else if (o.files.valid && !i) { %}
                    <div class="actions">{% if (!o.options.autoUpload) { %}
                        <div class="btn-group">
                        <button class="btn icon-upload-alt start"></button>
                        <button class="btn icon-remove cancel"></button>
                        </div>
                    {% } %}</div>
                {% } else { %}
                    <div></div>
                {% } %}

                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div>
                </div>
            </div>
        </div>
    {% } %}
    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        {% if (file.error) { %}        
            <div class="template-download fade clearfix">
                <div class="ts-info-top clearfix">
                    <span style="font-size: 15px;">{%=file.name%}</span> 
                    <span style="color: #999999; font-size: 12px;">({%=o.formatFileSize(file.size)%})</span>
                </div>
                <div class="ts-info-bottom clearfix">
                    <div class="ts-info-left clearfix">
                        <span class="label label-important">{%=locale.fileupload.error%}</span>
                    </div>
                    <div class="ts-info-right clearfix">
                        <div class="name clearfix"></div>
                        <div class="format_error">{%=locale.fileupload.errors[file.error] || file.error%}</div>
                    </div>
                </div>
                <div class="ts-info-action clearfix">
                    <div class="actions-error clearfix">
                        <div class="btn-group clearfix">
                            <span class="delete">
                                <button class="btn" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}" data-user="{%=file.decore_user%}" data-file="{%=file.decore_file%}" data-home="{%=file.decore_home%}"><i class="ss-trash"></i></button>
                            </span>
                        </div>
                    </div>
                </div>   
            </div>

        {% } else { %}
            <div class="template-download fade clearfix">
                <div class="ts-info-top clearfix">
                    <span class="file-title">{%=file.name%}</span>
                    <span class="file-size">({%=o.formatFileSize(file.size)%})</span>
                </div>
                
                <div class="ts-info-bottom clearfix">
                    <div class="ts-info-left light-medium clearfix">
                    </div>
                    <div class="ts-info-right clearfix">
                        <div class="name clearfix"></div>
                    </div>
                </div>
                <div class="ts-info-action clearfix">
                    <div class="actions clearfix">
                        <div class="btn-group clearfix">
                            <span class="result">
                            <span class="btn ss-search analyzeMe analyzeTooltip" data-toggle="tooltip" title="Analyze" href="{%=file.upload_home%}/analyze/{%=file.upload_user%}/{%=file.upload_file%}"></span>
                            </span>
                            <span class="download">
                                <a data-toggle="tooltip" title="Download" href="{%=file.upload_home%}/uploads/users/{%=file.upload_username%}/{%=file.upload_file%}" class="btn ss-download analyzeTooltip" download="{%=file.upload_file%}"></a>
                            </span>
                            <span class="delete">
                                <button class="btn analyzeTooltip" data-toggle="tooltip" title="Delete" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}" data-user="{%=file.upload_user%}" data-file="{%=file.upload_file%}" data-home="{%=file.upload_home%}"><i class="ss-trash"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        {% } %}
    {% } %}

    </script>
    <div id="backtotop" class="offset1">TOP</div>
    <div id="scrollTop"></div>
@endsection

@section('welcome')
    {{ View::make('layouts.welcome') }}
@endsection

@section('help')
    {{ View::make('layouts.help') }}
@endsection

@section('footer')
    {{ View::make('layouts.footer') }}
@endsection

@section('js-footer')
{{ HTML::script('bundles/jfileupload/js/jquery.ui.widget.js') }}
{{ HTML::script('bundles/jfileupload/js/tmpl.min.js') }}
{{ HTML::script('bundles/jfileupload/js/load-image.min.js') }}
{{ HTML::script('bundles/jfileupload/js/canvas-to-blob.min.js') }}
{{ HTML::script('bundles/jfileupload/js/bootstrap-image-gallery.min.js') }}
{{ HTML::script('bundles/jfileupload/js/jquery.iframe-transport.js') }}
{{ HTML::script('bundles/jfileupload/js/jquery.fileupload.js') }}
{{ HTML::script('bundles/jfileupload/js/jquery.fileupload-fp.js') }}
{{ HTML::script('bundles/jfileupload/js/jquery.fileupload-ui.js') }}
{{ HTML::script('bundles/jfileupload/js/locale.js') }}
{{ HTML::script('bundles/jfileupload/js/main.js') }}

@endsection
