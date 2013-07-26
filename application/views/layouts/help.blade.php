<div id="hardwareHelp" class="hide span12 help-div" style="position:absolute; top:0px; left:0px; z-index:1041;">
    <div style="background:white;">
        <h3>Hardware Info Help</h3>
        <i class="icon-remove help-close" style="float:left;"></i>
    </div>
    <div>
        <img src="../img/instruct/hwinfo.png">
    </div>
</div>

<div id="cliShowCommandsHelp" class="hide span12 help-div" style="position:absolute; top:0px; left:0px; z-index:1041;">
    <div style="background:white;">
        <h3>Show Commands Help</h3>
        <i class="icon-remove help-close" style="float:left;"></i>
    </div>
    <div>
        <img src="../img/instruct/hwinfo.png">
    </div>
</div>

<div id="cliLogsHelp" class="hide span12 help-div" style="position:absolute; top:0px; left:0px; z-index:1041;">
    <div style="background:white;">
        <h3>Log Help</h3>
        <i class="icon-remove help-close" style="float:left;"></i>
    </div>
    <div>
        <img src="../img/instruct/logs.png">
    </div>
</div>

<div id="cliHistoryHelp" class="hide span12 help-div" style="position:absolute; top:0px; left:0px; z-index:1041;">
    <div style="background:white;">
        <h3>CLI History Help</h3>
        <i class="icon-remove help-close" style="float:left;"></i>
    </div>
    <div>
        <img src="../img/instruct/hwinfo.png">
    </div>
</div>

<div id="configHelp" class="hide span12 help-div" style="position:absolute; top:0px; left:0px; z-index:1041;">
    <div style="background:white;">
        <h3>Configuration Help</h3>
        <i class="icon-remove help-close" style="float:left;"></i>
    </div>
    <div>
        <img src="../img/instruct/config.png">
    </div>
</div>

<div id="serviceHelp" class="hide span12 help-div" style="position:absolute; top:0px; left:0px; z-index:1041;">
    <div style="background:white;">
        <h3>Service Help</h3>
        <i class="icon-remove help-close" style="float:left;"></i>
    </div>
    <div>
        <img src="../img/instruct/service.png">
    </div>
</div>

<div id="searchHelp" class="hide span12 help-div" style="position:absolute; top:0px; left:0px; z-index:1041;">
    <div style="background:white;">
        <h3>Search Help</h3>
        <i class="icon-remove help-close" style="float:left;"></i>
    </div>
    <div>
        <img src="../img/instruct/search.png">
    </div>
</div>

<div id="help-cover" class="modal-backdrop hide"></div>

<script>
    $(function() {
        $('.help-close').click(function() {
            $(this).parents('.help-div').fadeOut('slow', function() {
                $('#help-cover').hide();
            });
        });
    });
</script>