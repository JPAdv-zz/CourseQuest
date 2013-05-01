<?php
/*
 This is a function that filters the string returned by the table.
*/
function filterRecord($s){

    // Check that the string is only a number.
    // Length of class.
    if(is_numeric($s)) {
        return $s." weeks";
    }

    //Check that the string contains the characters http.
    if(strpos($s, "http") !== false) {
        // Check if the string is from coursera. If so, set it to return the string "Coursera" only.
        if(strpos($s, "class.coursera.org") !== false){
            return $s="Coursera";
        }

//        if (strpos($s, "large-icon.png") !== false) {
//            $imageClass = "course-image";
//        }
//        else {
//            $imageClass = "professor-image";
//        }
//        return "<img class='an-tr-op ".$imageClass."' onload='this.style.opacity = 1;' src='".$s."'>";
    }
    else{
        return $s;
    }

        return $s;
    }
?>


    <div id="coursequest_player_container">
        <div id="vimeoPlayer"></div>
        <div id="coursequest_player"></div>
    </div>

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

<div id="tablecontainer">
<?php
    //$this->table->function = 'filterRecord';

echo $this->table->generate($records); ?>
</div>
<?php if($q == false){echo $this->pagination->create_links();} ?>