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

    // Check that the string contains the characters http.
    if(strpos($s, "http") !== false) {
        // Check if the string is from coursera. If so, set it to return the string "Coursera" only.
        if(strpos($s, "class.coursera.org") !== false){
            return $s="Coursera";
        }
    	
    	if (strpos($s, "large-icon.png") !== false) {
        	$imageClass = "course-image";
    	}
    	else {
    		$imageClass = "professor-image";
    	}
    	return "<img class='an-tr-op ".$imageClass."' onload='this.style.opacity = 1;' src='".$s."'>";
    }
    else{
        return $s;
    }
}
?>
<div id="tablecontainer">
<?php $this->table->function = 'filterRecord';
echo $this->table->generate($records); ?>
</div>
<?php echo $this->pagination->create_links(); ?>