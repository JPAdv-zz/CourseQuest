<?php
//Add some comments man... 
class crontasks extends CI_Controller {

    function index(){


    }

    function scrape_coursera(){

        $this->load->model("course_data");
        $this->load->model("course_details");

        echo "emptying the tables....";

        $this->course_data->emptyTable();
        $this->course_details->emptyTable();

        echo " done!<br/>";
        echo "scraping coursera....<br/>";

        $urls = (object) array("coursesJson" => "https://d1hpa2gdx2lr6r.cloudfront.net/maestro/api/topic/list");

        $coursesJson = json_decode(file_get_contents($urls->coursesJson));

        $topics = $coursesJson;
        $tt = false;
        $reason = "";

        foreach($topics as $topic){

            //echo

            $tt = false;

            $courseJson = json_decode(file_get_contents("https://www.coursera.org/maestro/api/topic/information?topic-id=".$topic->short_name));
            $instructorJson = json_decode(file_get_contents("https://www.coursera.org/maestro/api/user/instructorprofile?exclude_topics=1&topic_short_name=".$topic->short_name));

            if(!$courseJson->social_link){
                $courseJson->social_link = "https://www.coursera.org/";
            }

            $catStr = "";
            foreach($courseJson->categories as $cat){
                if($catStr == ""){
                    $catStr .= $cat->name;
                }else{
                    $catStr .= ", ".$cat->name;
                }
            }

            $courseJson->category = substr($catStr,0,99);

            if($courseJson->video == ""){
                $courseJson->video_link = "";
            }else{
                $courseJson->video_link = "http://www.youtube.com/watch?v=".$courseJson->video;
            }


            foreach($courseJson->courses as $course){
                if($course->start_year && $course->duration_string != ""){
                    $courseJson->start_date = $course->start_year."-".str_pad($course->start_month,2,'0', STR_PAD_LEFT)."-".str_pad($course->start_day,2,'0', STR_PAD_LEFT);
                    $arr = explode(" ",$course->duration_string);
                    $courseJson->course_length = $arr[0];
                    $courseJson->site = $course->home_link;
                    $id = $this->course_data->insertRow($courseJson);
                    $tt = true;
                    foreach($instructorJson as $instructor){
                        $instructor->id = $id;
                        $this->course_details->insertRow($instructor);
                    }

                }else{
                    $reason = "missing start year or duration";
                }
            }

            if($tt != true){
                echo "rejected : ".$topic->short_name." / reason : ".$reason;
                echo "<br/>";
            }else{
                echo "accepted : ".$topic->short_name;
                echo "<br/>";
            }
        }

        echo " done!";
    }

}