<script>
    var searchtimer;
    var currentSearch;
    var currentView = 'gridView';

    $(document).ready(function(){

        $.getJSON(
            '<?php echo base_url(); ?>index.php/api/get_tags/?callback=?',function(data){
                $( "#search_box" ).autocomplete({
                    source: data,
                    open: function(){
                        $(this).autocomplete('widget').css({'z-index': '104',
                            'max-height' : '218px',
                            'overflow' : 'hidden',
                            'background' : 'rgba(0,0,0,.8)',
                            'width': '356px',
                            'border-radius' : '0px',
                            'font-size' : '14px'
                        });
                        return false;
                    },
                    select : search
                });
            }
        );

        if($('#search_box').val() !== ''){
            search();
        }

        $('#search_box').change(search);
        $('#search_box').keyup(search);
    });

    function search(force){
        $('#loading_logo').css('visibility','visible');
        if(searchtimer){
            clearTimeout(searchtimer);
        }
        searchtimer = setTimeout(function(){
            var q = $('#search_box').val();

            if(q === currentSearch & force !== true){
                $('#loading_logo').css('visibility','hidden');
                return;
            }
            if(q === ''){
                currentSearch = q;
                $("#tablecontainer")[0].innerHTML = '';
                $('#loading_logo').css('visibility','hidden');
                return;
            }

            if(currentView == 'listView'){
                $.get('<?php echo base_url(); ?>index.php/content_table/?q='+encodeURI(q),function(data){
                    currentSearch = q;
                    renderResults(data);
                });
            }else if(currentView == 'gridView'){
                $.get('<?php echo base_url(); ?>index.php/api/search/?q='+encodeURI(q),function(data){
                    currentSearch = q;
                    renderResults(data);
                });
            }


        },600);


    }

    function renderResults(data){
        if(currentView == 'listView'){
            $("#tablecontainer")[0].innerHTML = data;
            $('#list_view_button').addClass('active');
            $('#grid_view_button').removeClass('active');
        }else if(currentView == 'gridView'){

            var df = document.createDocumentFragment();

            for(var i = 0; i < data.length; i++){
                var elem = document.createElement('div');
                elem.className = 'grid_result_item';
                elem.innerHTML ="<div class='play-button-container'><div onclick='loadPreviewVideo(\""+data[i].video_link+"\")' class='play-button'></div></div>"+
                    "<img class='result_img an-tr-op' onload='this.style.opacity = 1;' onclick='loadPreviewVideo(\""+data[i].video_link+"\");' src='"+data[i].course_image+"'/><div class='result_details'><div class='result_title'>"+data[i].title+"</div></div>";

                df.appendChild(elem);
            }

            $("#tablecontainer").empty();
            $("#tablecontainer")[0].appendChild(df);
            $('#grid_view_button').addClass('active');
            $('#list_view_button').removeClass('active');
        }
        $('#loading_logo').css('visibility','hidden');
    }

</script>


<div id="coursequest_player_container" style="z-index: 105">
    <div id="vimeoPlayer"></div>
    <div id="coursequest_player"></div>
</div>

<div id="search_container">
    <div id="search_padding">
        <input id="search_box" value="math" placeholder="What would you like to learn?" type="text" name="q" speech="speech" x-webkit-speech="x-webkit-speech" onspeechchange="search();" onwebkitspeechchange="search();" size=200/>
    </div>

    <div id="loading_logo">
        <div id="facebookG">
            <div id="blockG_1" class="facebook_blockG">
            </div>
            <div id="blockG_2" class="facebook_blockG">
            </div>
            <div id="blockG_3" class="facebook_blockG">
            </div>
        </div>
    </div>

</div>

<nav class="view_selectors">
    <button class="button_1" id="list_view_button" onclick="currentView = 'listView';search(true);">List View</button>
    <button class="button_1" id="grid_view_button" onclick="currentView = 'gridView';search(true);">Grid View</button>
</nav>

<div id="tablecontainer">

</div>