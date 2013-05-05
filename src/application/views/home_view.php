<script>
    var searchtimer;
    var currentSearch;
    var currentView = 'gridView';

    $(document).ready(function(){

        $( document ).tooltip({
            position: {
                my: "center bottom-20",
                at: "center top",
                using: function( position, feedback ) {
                    $( this ).css( position );
                    $( "<div>" )
                        .addClass( "arrow" )
                        .addClass( feedback.vertical )
                        .addClass( feedback.horizontal )
                        .appendTo( this );
                }
            }
        });

        $.get('<?php echo base_url(); ?>index.php/api/featured_courses',function(data){
            renderJsonResults(data,'featured_courses');
        });

        $.getJSON(
            '<?php echo base_url(); ?>index.php/api/get_tags/?callback=?',function(data){
                $( "#search_box" ).autocomplete({
                    source: data,
                    open: function(){
                        $(this).autocomplete('widget').css({
                            'z-index': '104',
                            'max-height' : '318px',
                            'overflow' : 'hidden',
                            'background' : 'rgba(255,255,255, 0.95)',
                            'box-shadow' : '0 1px 2px rgba(0,0,0,0.4)',
                            'width': '358px',
                            'border-color' : 'white',
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
                    renderJsonResults(data,'tablecontainer');
                });
            }else if(currentView == 'gridView'){
                $.get('<?php echo base_url(); ?>index.php/api/search/?q='+encodeURI(q),function(data){
                    currentSearch = q;
                    renderJsonResults(data,'tablecontainer');
                });
            }

            $('#search_term')[0].innerHTML = q;


        },600);


    }

    function renderJsonResults(data,id){
        if(currentView == 'listView'){
            $("#"+id)[0].innerHTML = data;
            $('#list_view_button').addClass('active');
            $('#grid_view_button').removeClass('active');
        }else if(currentView == 'gridView'){

            var df = document.createDocumentFragment();

            for(var i = 0; i < data.length; i++){
                var elem = document.createElement('div');
                elem.className = 'grid_result_item';
                elem.innerHTML ="<div class='play-button-container'><div onclick='loadPreviewVideo(\""+data[i].video_link+"\")' class='play-button'></div><div class='grid_view_more_info an-tr-op' title='Description: "+data[i].short_desc+" / Start Date is "+data[i].start_date+". / Duration is "+data[i].course_length+" weeks.'>i</div></div>"+
                    "<img class='result_img an-tr-op' onload='this.style.opacity = 1;' onclick='loadPreviewVideo(\""+data[i].video_link+"\");' src='"+data[i].course_image+"'/><div class='result_details'><a href='"+data[i].course_link+"' class='result_title'>"+data[i].title+"</a></div>";

                df.appendChild(elem);
            }

            $("#"+id).empty();
            $("#"+id)[0].appendChild(df);
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
            <!-- The main header of the site. -->
            <header class="nav-bar">    
                <div class="nav-inner">
                    <a href="<?php echo base_url()."index.php/home"; ?>" class="nav-btn" id="logo">CourseQuest</a>
                    <div class="nav-container">
                        <ul>
                            <button class="button_1" id="list_view_button" onclick="currentView = 'listView';search(true);">List View</button>
                            <button class="button_1" id="grid_view_button" onclick="currentView = 'gridView';search(true);">Grid View</button>
                        </ul>
                    </div>
                 </div>
            </header>
    <div id="search_padding">
        <input id="search_box" placeholder="What would you like to learn?" type="text" name="q" speech="speech" x-webkit-speech="x-webkit-speech" onspeechchange="search();" onwebkitspeechchange="search();" size=300/>
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

<h3 id="search_term" style="margin-top: 70px;"></h3>
<div id="tablecontainer" style="padding-top: 0;">

</div>

<h3>Featured Courses</h3>
<div id="featured_courses">

</div>