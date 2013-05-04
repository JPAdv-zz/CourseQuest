
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