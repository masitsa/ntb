<link rel="stylesheet" href="<?php echo base_url();?>assets/themes/minified/themes/default.min.css" type="text/css" media="all" />

<script src="<?php echo base_url();?>assets/themes/minified/jquery.sceditor.bbcode.min.js"></script>
<script>
// Source: http://www.backalleycoder.com/2011/03/20/link-tag-css-stylesheet-load-event/
var loadCSS = function(url, callback){
    var link = document.createElement('link');
    link.type = 'text/css';
    link.rel = 'stylesheet';
    link.href = url;
    link.id = 'theme-style';

    document.getElementsByTagName('head')[0].appendChild(link);

    var img = document.createElement('img');
    img.onerror = function(){
        if(callback) callback(link);
    }
    img.src = url;
}

$(document).ready(function() {
    var initEditor = function() {
        $("textarea").sceditor({
            plugins: 'bbcode',
            style: "./minified/jquery.sceditor.default.min.css"
        });
    };

    $("#theme").change(function() {
        var theme = "./minified/themes/" + $(this).val() + ".min.css";

        $("textarea").sceditor("instance").destroy();
        $("link:first").remove();
        $("#theme-style").remove();

        loadCSS(theme, initEditor);
    });

    initEditor();
});
</script>
<div class="control-group">
    <label for="review_text" class="control-label">Meeting Agenda</label>
    
    <div class="controls">
        <!-- <textarea name="bbcode_field" id="bbcode_field2" class="col-md-12" style="height:200px;width:800px;" ></textarea> -->
        <?php
           
           $agenda = $this->site_model->get_meeting_agenda($meeting_id);

            if($agenda->num_rows() > 0)
            {
                foreach ($agenda->result() as $agend)
                {
                    $meeting_agenda = $agend->meeting_agenda;
                }
                ?>
                <textarea id="editor2" name="editor2" rows="20" cols="100" style="100%" class="form-control col-md-6" ><?php echo $meeting_agenda;?></textarea>
                <?php
            }
            else
            {
                ?>
                <textarea id="editor2" name="editor2" rows="20" cols="100" style="100%" class="form-control col-md-6" ></textarea>
                <?php
            }
        ?>
    </div>
</div>