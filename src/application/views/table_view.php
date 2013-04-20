<?php
function filterRecord($s){
    if(strpos($s, "http") !== false){
    	
    	if (strpos($s, "large-icon.png") !== false) {
        	$imageClass = "course-image";
    	}
    	else {
    		$imageClass = "professor-image";
    	}
    	return "<img class='an-tr-op ".$imageClass."' onload='this.style.opacity = 1;' src='".$s."'>";

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