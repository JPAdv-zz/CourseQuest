<?php

class content_table extends CI_Controller{
    function index(){
        $this->load->library('pagination');
        $this->load->library('table');

        $q = $this->input->get('q', TRUE);


        $this->table->set_heading(array('Image', 'Course Name', 'Category', 'Start Date', 'Course Length (Weeks)', 'Professor', 'Instructor Image', 'Site'));

        $config["base_url"] = base_url()."index.php/content_table/index";
        $config["per_page"] = 10;
        $config["num_links"] = 15;
        $config["full_tag_open"] = "<div class='pagination'>";
        $config["full_tag_close"] = "</div>";

        if($q){
            $config["total_rows"] = $this->db->query("SELECT course_image,course_link,title,category,start_date,course_length,profname,profimage,site,video_link FROM course_data,coursedetails where (UPPER(course_data.title) LIKE UPPER('%".$q."%') OR UPPER(course_data.short_desc) LIKE UPPER('%".$q."%') OR UPPER(course_data.category) LIKE UPPER('%".$q."%') OR UPPER(coursedetails.profname) LIKE UPPER('%".$q."%')) AND coursedetails.id  = course_data.id GROUP BY course_data.id")->num_rows();
        }else{
            $config["total_rows"] = $this->db->get("course_data")->num_rows();
        }

        $this->pagination->initialize($config);

        //$data["records"] = $this->db->get('course_data',$config["per_page"],$this->uri->segment(3));

        $seg = $this->uri->segment(3);

        if(!$seg){
            $seg = 0;
        }

        if($q){
            $recxx = $this->db->query("SELECT course_image,course_link,title,category,start_date,course_length,profname,profimage,site,video_link FROM course_data,coursedetails where (UPPER(course_data.title) LIKE UPPER('%".$q."%') OR UPPER(course_data.short_desc) LIKE UPPER('%".$q."%') OR UPPER(course_data.category) LIKE UPPER('%".$q."%') OR UPPER(coursedetails.profname) LIKE UPPER('%".$q."%')) AND coursedetails.id  = course_data.id GROUP BY course_data.id");
        }else{
            $recxx = $this->db->query("SELECT course_image,course_link,title,category,start_date,course_length,profname,profimage,site,video_link FROM course_data,coursedetails where coursedetails.id  = course_data.id GROUP BY course_data.id LIMIT ".$seg.",".$config["per_page"]);
        }

        $rec = $recxx->result_array();
        $rs = array();
        foreach($rec as $r){
            $r["course_image"] = "<div class='an-tr-op play-button-container' onload='this.style.opacity = 1;' style='opacity: 1;'><div onclick='loadPreviewVideo(\"".$r["video_link"]."\")' class='play-button'/></div></div><img class='an-tr-op course-image' onclick='loadPreviewVideo(\"".$r["video_link"]."\")' onload='this.style.opacity = 1;' src='".$r["course_image"]."' style='opacity: 0;'/>";
            $r["profimage"] = "<img class='an-tr-op professor-image' onload='this.style.opacity = 1;' src='".$r["profimage"]."' style='opacity: 0;'/>";
            $r["title"] = "<a href='".$r["course_link"]."'>".$r["title"]."</a>";

            if(strpos($r["site"],"class.coursera.org") > 0){
                $r["site"] = "Coursera";
            }
            unset($r["video_link"]);
            unset($r["course_link"]);
            $rs[] = $r;
        }

        $data["records"] = $rs;


        if($q){
            $data["q"] = true;
            $this->load->view("table_view_q",$data);
        }else{
            $data["q"] = false;
            $data["main_content"] = "table_view";
            $this->load->view("templates/base_template",$data);
        }


    }
}