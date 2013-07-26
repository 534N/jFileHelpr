@layout('layouts/default')

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
    <li class="active">Files</li>
</ul>
<ul class="nav nav-tabs">
    <li>{{ HTML::link('admin/user/'.$user->id, 'General') }}</li>
    <li class="active">{{ HTML::link('#', 'Files') }}</li>
    <li>{{ HTML::link('admin/user/'.$user->id.'/delete', 'Delete') }}</li>
</ul>
<style>
.fileinput-button {
    width: 202px;
}
.fileupload-buttonbar .start, .fileupload-buttonbar .cancel, .fileupload-buttonbar .delete {
    width: 224px;
}
.fileupload-buttonbar label {
    display: inline;
    width: 170px;
}
td.deletecheck {
    width: 25px;
    margin: 0px;
    padding: 0px;
    padding-top: 5px;
}
td.deletecheck > span.checkbox {
    margin: 0px;
    padding: 8px 0px 0px 0px;
}
td.deletecheck > span.checkbox > label {
    height: 15px;
    margin: 0px;
    padding: 0px;
}
td.name {
    width: 800px;
    padding-top: 10px;
    padding-left: 10px;
}
td.delete, td.actions {
    max-width: 120px;
    padding: 5px 2px !important;
    text-align: center !important;
}
td.delete a, td.delete button, td.actions a, td.actions button {
    font-size: 18px !important;
    padding-top: 5px;
}
td.name .progress {
    margin-bottom: 0px;
}
</style>
<div class="tab-content">
	<div class="tab-pane active" id="course-info">
        {{ Form::open_for_files('admin/user/'.$user->id.'/upload/','POST',array('id' => 'fileupload')) }}
        <legend>Upload files to the user folder</legend>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="fileupload-buttonbar" style="height: 100px;">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <div class="input-prepend input-append" style="display:block;">
                <span class="btn fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>Upload Files</span>
                    <input type="file" name="files[]" multiple style="height: 20px; border: 0px;">
                </span>
                <button type="submit" class="btn start">
                    <i class="icon-upload icon-white"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span>Delete files</span>
                </button>
            </div>
            <span class="checkbox">
                {{ Form::checkbox('selecall', 1, 0, array('id' => 'selecall', 'class' => 'field login-checkbox toggle')) }}
                {{ Form::label('selecall', 'Select all files') }}
            </span>
            <!-- The global progress information -->
            <div class="fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The loading indicator is shown during file processing -->
        <div class="fileupload-loading"></div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped table-condensed table-hover table-bordered">
        <thead>
            <tr>
                <th colspan="5">Files in the user folder</th>
            </tr>
        </thead>
        <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery">
        </tbody>
        </table>
    {{ Form::token() }}
    {{ Form::close() }}
    </div>

    <!-- The template to display files available for upload -->
    <script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload fade">
            <td class="deletecheck"></td>
            <td class="name">
                <span style="margin-right: 10px; font-weight: bold;">Filename:</span> <span>{%=file.name%}</span> <span style="color: #999999;">({%=o.formatFileSize(file.size)%})</span>
                <div class="pull-right progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            </td>
            {% if (file.error) { %}
                <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
            {% } else if (o.files.valid && !i) { %}
                <td class="actions">{% if (!o.options.autoUpload) { %}
                    <div class="btn-group">
                    <button class="btn icon-upload start"></button>
                    <button class="btn icon-ban-circle cancel"></button>
                    <a href="#" class="btn btn-danger icon-trash disabled"></a>
                    </div>
                {% } %}</td>
            {% } else { %}
                <td colspan="2"></td>
            {% } %}
        </tr>
    {% } %}
    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade">
            {% if (file.error) { %}
                <td class="deletecheck"></td>
                <td class="name">
                    <span style="margin-right: 10px; font-weight: bold;">{{ Lang::line('localization.name') }}:</span> <span>{%=file.name%}</span> <span style="color: #999999;">({%=o.formatFileSize(file.size)%})</span>
                    <div class="pull-right"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</div>
                </td>
            {% } else { %}
                <td class="deletecheck">
                    <span class="checkbox clearfix">
                        <button data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}" style="display: none;"></button>
                        <input type="checkbox" name="delete" id="select{%=i %}" class="login-checkbox">
                        <label for="select{%=i %}">
                    </span>
                </td>
                <td class="name">
                    <span style="margin-right: 10px; font-weight: bold;">Filename:</span> <span>{%=file.name%}</span> <span style="color: #999999;">({%=o.formatFileSize(file.size)%})</span>
                </td>
            {% } %}
                <td class="delete" colspan="2">
                    <div class="btn-group">
                    <a href="#" class="btn icon-upload disabled"></a>
                    <a href="#" class="btn icon-ban-circle disabled"></a>
                    <button class="btn btn-danger icon-trash" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"></button>
                    </div>
                </td>
        </tr>
    {% } %}
    </script>
	</div>
</div>
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
