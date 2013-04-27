<?php

class TreeView extends CI_Controller {

	public function index()
	{
        $data["main_content"] = "tree_view";
        $this->load->view("templates/base_template",$data);
	}
}
