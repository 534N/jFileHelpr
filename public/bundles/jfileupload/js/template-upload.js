// {% for (var i=0, file; file=o.files[i]; i++) { %}
//     <tr class="template-upload fade">
//         <td class="preview"><span class="fade"></span></td>
//         <td class="name"><span>{%=file.name%}</span></td>
//         <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
//         {% if (file.error) { %}
//             <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
//         {% } else if (o.files.valid && !i) { %}
//             <td>
//                 <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
//             </td>
//             <td class="start">{% if (!o.options.autoUpload) { %}
//                 <button class="btn btn-primary">
//                     <i class="icon-upload icon-white"></i>
//                     <span>{%=locale.fileupload.start%}</span>
//                 </button>
//             {% } %}</td>
//         {% } else { %}
//             <td colspan="2"></td>
//         {% } %}
//         <td class="cancel">{% if (!i) { %}
//             <button class="btn btn-warning">
//                 <i class="icon-ban-circle icon-white"></i>
//                 <span>{%=locale.fileupload.cancel%}</span>
//             </button>
//         {% } %}</td>
//     </tr>
// {% } %}

{% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="template-upload fade">
        <div class="preview"><span class="fade"></span></div>
        <div class="name"><span>{%=file.name%}</span></div>
        <div class="size"><span>{%=o.formatFileSize(file.size)%}</span></div>
        {% if (file.error) { %}
            <div class="error"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</div>
        {% } else if (o.files.valid && !i) { %}
            <div>
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            </div>
            <div class="start">{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary">
                    <i class="icon-upload icon-white"></i>
                    <span>{%=locale.fileupload.start%}</span>
                </button>
            {% } %}</div>
        {% } else { %}
            <div></div>
        {% } %}
        <div class="cancel">{% if (!i) { %}
            <button class="btn btn-warning">
                <i class="icon-ban-circle icon-white"></i>
                <span>{%=locale.fileupload.cancel%}</span>
            </button>
        {% } %}</div>
    </div>
{% } %}