<?php

class home extends CI_Controller{

    function index(){
        $data["main_content"] = "home_view";
        $this->load->view("templates/base_template",$data);
    }

}
