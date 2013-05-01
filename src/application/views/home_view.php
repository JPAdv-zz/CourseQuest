<script>
    var searchtimer;
    $(document).ready(function(){
       if($('#search_box').val() !== ''){
            search($('#search_box').val());
       }

       $('#search_box').keyup(function(){
           $('#loading_logo').css('visibility','visible');
           var q = $(this).val();
           if(searchtimer){
               clearTimeout(searchtimer);
           }
           searchtimer = setTimeout(function(){
                search(q);
           },600);
       });
    });

    function search(q){
        if(q === ''){
            $("#tablecontainer")[0].innerHTML = '';
            $('#loading_logo').css('visibility','hidden');
            return;
        }
        $.get('<?php echo base_url(); ?>index.php/content_table/?q='+q,function(data){
            $("#tablecontainer")[0].innerHTML = data;
            $('#loading_logo').css('visibility','hidden');
        });
    }

    function renderResults(data){

    }
</script>


<div id="coursequest_player_container" style="z-index: 104">
    <div id="vimeoPlayer"></div>
    <div id="coursequest_player"></div>
</div>

<div id="search_container">
    <div id="search_padding">
        <input id="search_box" placeholder="What would you like to learn?" type="text" />
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