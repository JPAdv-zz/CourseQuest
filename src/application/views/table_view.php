<?php
function filterRecord($s){
    if(strpos($s, "http") !== false){
        return "<img src='".$s."'>";
    }else{
        return $s;
    }
}
?>
<div id="tablecontainer">
<?php $this->table->function = 'filterRecord';
echo $this->table->generate($records); ?>
</div>
<?php echo $this->pagination->create_links(); ?>