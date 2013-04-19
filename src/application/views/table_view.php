<?php
function filterRecord($s){
    if(strpos($s, "http") !== false){
    	
    	if (strpos($s, "large-icon.png") !== false) {
        	$imageID = "course-image";
    	}
    	else {
    		$imageID = "professor-image";
    	}
    	return "<img id='".$imageID."' src='".$s."'>";

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