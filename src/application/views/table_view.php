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

    <script>
        // 2. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player;
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('coursequest_player', {
                height: '390',
                width: '640',
                videoId: '',
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        // 4. The API will call this function when the video player is ready.
        function onPlayerReady(event) {
            event.target.playVideo();
        }

        // 5. The API calls this function when the player's state changes.
        //    The function indicates that when playing a video (state=1),
        //    the player should play for six seconds and then stop.
        var done = false;
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING && !done) {
                setTimeout(stopVideo, 6000);
                done = true;
            }
        }
        function stopVideo() {
            player && player.stopVideo();
        }

        $(document).ready(function(){
            stopVideo();
            $("#coursequest_player_container").click(function() {
                stopVideo();
                $(this).fadeOut('slow');
            });
        });

        loadPreviewVideo = function(url){
            var len = url.length;
            var id = url.substring(url.indexOf("v=")+2,len);
            player.loadVideoById(id);
            $("#coursequest_player_container").fadeIn('slow');
        };
    </script>

    <div id="coursequest_player_container">
        <div id="coursequest_player"></div>
    </div>

<div id="tablecontainer">
<?php
    //$this->table->function = 'filterRecord';

echo $this->table->generate($records); ?>
</div>
<?php echo $this->pagination->create_links(); ?>