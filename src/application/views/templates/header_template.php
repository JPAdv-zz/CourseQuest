<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
            <title>CourseQuest</title>
            <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/javascript/jquery.tablesorter.min.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>assets/javascript/table_sort.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>assets/javascript/jquery-ui.js" type="text/javascript"></script>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/costum.css" type="text/css" media="screen" charset="utf-8"/>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/table_view.css" type="text/css" media="screen" charset="utf-8"/>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/home_view.css" type="text/css" media="screen" charset="utf-8"/>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/jquery-ui.css" type="text/css" media="screen" charset="utf-8"/>
            <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300' rel='stylesheet' type='text/css'>
        </head>

        <script>

            $(document).ready(function(){
                $("#coursequest_player_container").click(function() {
                    $(this).fadeOut('slow');
                    $("#vimeoPlayer").empty();
                    $("#coursequest_player").empty();

                });

            });

            loadPreviewVideo = function(url){
                if(url.indexOf("v=") > 0){
                    $("#vimeoPlayer").toggle(false);
                    $("#coursequest_player").toggle(true);
                    var len = url.length;
                    var id = url.substring(url.indexOf("v=")+2,len);
                    url = encodeURI("http://www.youtube.com/embed/"+id+"?enablejsapi=1&autoplay=1&origin=http:\/\/"+window.location.host);

                    $("#coursequest_player_container").fadeIn('slow');

                    $("#coursequest_player")[0].innerHTML = "<iframe id='player' type='text/html' width='640' height='390'" +
                        "src='"+url+"' frameborder='0'/>";
                }else{
                    $("#coursequest_player").toggle(false);
                    $("#vimeoPlayer").toggle(true);
                    $("#vimeoPlayer")[0].innerHTML = "<iframe src='"+url+"/?autoplay=1' width='640' height='390' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen/>";
                    $("#coursequest_player_container").fadeIn('slow');
                }

            };
        </script>

        <body>

