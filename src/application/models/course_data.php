<?php

class course_data extends CI_Model {

    function insertRow($o){

        $data = array(
            "title" => $o->name,
            "short_desc" => $o->short_description,
            "long_desc" => $o->about_the_course,
            "course_link" => $o->social_link,
            "video_link" => $o->video_link,// need to add -----
            "start_date" => $o->start_date,// need to add -----
            "course_length" => $o->course_length, // need to add ------
            "course_image" => $o->large_icon,
            "category" => $o->category, //need to add -------
            "site" => $o->site, //need to add
        );

        $this->db->insert('course_data',$data);
        return $this->db->insert_id();

    }

}