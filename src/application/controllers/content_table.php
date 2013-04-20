<?php

class content_table extends CI_Controller{
    function index(){
        $this->load->library('pagination');
        $this->load->library('table');
        $this->load->helper('url');

        $this->table->set_heading(array('', 'Course Name', 'Category', 'Start Date', 'Course Length', 'Professor', '', 'Site'));

        $config["base_url"] = base_url()."index.php/content_table/index";
        $config["total_rows"] = $this->db->get("course_data")->num_rows();
        $config["per_page"] = 10;
        $config["num_links"] = 20;
        $config["full_tag_open"] = "<div class='pagination'>";
        $config["full_tag_close"] = "</div>";

        $this->pagination->initialize($config);

        //$data["records"] = $this->db->get('course_data',$config["per_page"],$this->uri->segment(3));

        $seg = $this->uri->segment(3);

        if(!$seg){
            $seg = 0;
        }

        $rec = $this->db->query("SELECT course_image,title,category,start_date,course_length,profname,profimage,site FROM course_data,coursedetails where coursedetails.id  = course_data.id LIMIT ".$seg.",".$config["per_page"]);

        $data["records"] = $rec;
        $data["main_content"] = "table_view";

        $this->load->view("templates/base_template",$data);
    }
}