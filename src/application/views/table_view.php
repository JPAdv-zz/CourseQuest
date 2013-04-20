<?php
function filterRecord($s){
    if(strpos($s, "http") !== false){
    	
    	if (strpos($s, "large-icon.png") !== false) {
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
        if(strpos($s, "image.jpg") !== false) {
            $imageID = "course-image";
            return "<img id='".$imageID."' src='".$s."'>";
        }

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