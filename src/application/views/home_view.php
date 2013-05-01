<script>
    $(document).ready(function(){
       $('#search_box').keyup(function(){
           var q = $(this).val();
           $.get('<?php echo base_url(); ?>index.php/content_table/?q='+q,function(data){
                $("#tablecontainer")[0].innerHTML = data;
           });
       });
    });

    function renderResults(data){

    }
</script>


<div id="coursequest_player_container">
    <div id="vimeoPlayer"></div>
    <div id="coursequest_player"></div>
</div>

<div id="search_container">
    <div id="search_padding">
        <input id="search_box" placeholder="What would you like to learn?" type="text" />
    </div>
</div>

<div id="tablecontainer">

</div>