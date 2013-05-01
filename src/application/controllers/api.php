<?php

class api extends CI_Controller{

    function search(){
        $this->load->library('table');
        $q = $this->input->get('q', TRUE);
        $start_index = $this->input->get('si', TRUE);
        $size = $this->input->get('size', TRUE);

        if(!$q){
            return;
        }

        if(!$start_index){
            $start_index = 0;
        }

        if(!$size){
            $size = 10;
        }

        if($size > 50){
            $size = 50;
        }

        $total = $this->db->query("SELECT course_image,course_link,title,category,start_date,course_length,profname,profimage,site,video_link FROM course_data,coursedetails where (UPPER(course_data.title) LIKE UPPER('%".$q."%') OR UPPER(course_data.short_desc) LIKE UPPER('%".$q."%') OR UPPER(course_data.category) LIKE UPPER('%".$q."%')) AND coursedetails.id  = course_data.id GROUP BY course_data.id")->num_rows();

        $rec = $this->db->query("SELECT course_image,course_link,title,category,start_date,course_length,profname,profimage,site,video_link FROM course_data,coursedetails where (UPPER(course_data.title) LIKE UPPER('%".$q."%') OR UPPER(course_data.short_desc) LIKE UPPER('%".$q."%') OR UPPER(course_data.category) LIKE UPPER('%".$q."%')) AND coursedetails.id  = course_data.id GROUP BY course_data.id");

        echo $this->table->generate($rec);
    }

    function get_tags(){

        $rec = $this->db->query("SELECT title FROM course_data,coursedetails where  coursedetails.id  = course_data.id GROUP BY course_data.title");

        $res = $rec->result();

        $callback = $this->input->get('callback',TRUE);

        $rr = array();
        foreach($res as $r){
            $rr[] = trim($r->title);
        }

        $rec = $this->db->query("SELECT category FROM course_data,coursedetails where  coursedetails.id  = course_data.id GROUP BY course_data.category");

        $res = $rec->result();
        foreach($res as $r){
            $rr[] = trim($r->category);
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output($callback."(".json_encode($rr).");");


    }

}