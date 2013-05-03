<?php

class course_details extends CI_Model {

    function insertRow($o){

        $data = array(
            "id" => $o->id,
            "profname" => trim($o->first_name)." ".trim($o->last_name),
            "profimage" => trim($o->photo)
        );

        $this->db->insert('coursedetails',$data);
        return $this->db->insert_id();

    }

    function emptyTable(){
        $this->db->empty_table('coursedetails');
    }

}