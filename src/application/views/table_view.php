<?php
function filterRecord($s){
    if(strpos($s, "http") !== false){
    	
    	if (strpos($s, "large-icon.png") !== false) {
/**<<<<<<< HEAD
        	$imageID = "course-image";
            return "<img id='".$imageID."' src='".$s."'>";
    	}
    	if(strpos($s, "coursera-instructor") !== false){
    		$imageID = "professor-image";
            return "<img id='".$imageID."' src='".$s."'>";
    	}
        if(strpos($s, "class.coursera.org") !== false){
            return "<a id='class-link' href='".$s."'>Coursera</a>";
        }
        
        if(strpos($s, "image.jpg") !== false) {
            $imageID = "course-image";
            return "<img id='".$imageID."' src='".$s."'>";
        }
        if(strpos($s, "avatar.jpg") !== false) {
            $imageID = "professor-image";
            return "<img id='".$imageID."' src='".$s."'>";
        }
        if(strpos($s, "canvas.net/courses") !== false) {
            return "<a id='class-link' href='".$s."'>Canvas</a>";;
        }
=======*/
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