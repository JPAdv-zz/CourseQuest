<?php

class course_data extends CI_Model {

    function insertRow($o){

        $data = array(
            "title" => trim($o->name),
            "short_desc" => trim($o->short_description),
            "long_desc" => trim($o->about_the_course),
            "course_link" => trim($o->social_link),
            "video_link" => trim($o->video_link),// need to add -----
            "start_date" => trim($o->start_date),// need to add -----
            "course_length" => trim($o->course_length), // need to add ------
            "course_image" => trim($o->large_icon),
            "category" => trim($o->category), //need to add -------
            "site" => trim($o->site), //need to add
        );

        $this->db->insert('course_data',$data);
        return $this->db->insert_id();

    }

    function emptyTable(){
        $this->db->empty_table('course_data');
    }

}