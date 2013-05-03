<script>
    var searchtimer;
    var currentSearch;
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

    function search(){
        $('#loading_logo').css('visibility','visible');
        if(searchtimer){
            clearTimeout(searchtimer);
        }
        searchtimer = setTimeout(function(){
            var q = $('#search_box').val();

            if(q === currentSearch){
                $('#loading_logo').css('visibility','hidden');
                return;
            }
            if(q === ''){
                currentSearch = q;
                $("#tablecontainer")[0].innerHTML = '';
                $('#loading_logo').css('visibility','hidden');
                return;
            }

            $.get('<?php echo base_url(); ?>index.php/content_table/?q='+q,function(data){
                currentSearch = q;
                $("#tablecontainer")[0].innerHTML = data;
                $('#loading_logo').css('visibility','hidden');
            });
        },600);


    }

</script>


<div id="coursequest_player_container" style="z-index: 105">
    <div id="vimeoPlayer"></div>
    <div id="coursequest_player"></div>
</div>

<div id="search_container">
    <div id="search_padding">
        <input id="search_box" placeholder="What would you like to learn?" type="text" name="q" speech="speech" x-webkit-speech="x-webkit-speech" onspeechchange="search();" onwebkitspeechchange="search();" size=200/>
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

<div id="tablecontainer" style="margin-top:80px">

</div>