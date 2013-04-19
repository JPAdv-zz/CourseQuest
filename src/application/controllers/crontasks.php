<?php
//Add some comments man... 
class CronTasks extends CI_Controller {

    function scrape_coursera(){

        $this->load->model("course_data");
        $this->load->model("courseDetails");

        echo "emptying the tables....";

        $this->course_data->emptyTable();
        $this->courseDetails->emptyTable();

        echo " done!<br/>";
        echo "scraping coursera....";

        $urls = (object) array("coursesJson" => "https://d1hpa2gdx2lr6r.cloudfront.net/maestro/api/topic/list2");

        $coursesJson = json_decode(file_get_contents($urls->coursesJson));

        $topics = $coursesJson->topics;

        foreach($topics as $topic){
            $courseJson = json_decode(file_get_contents("https://www.coursera.org/maestro/api/topic/information?topic-id=".$topic->short_name));
            $instructorJson = json_decode(file_get_contents("https://www.coursera.org/maestro/api/user/instructorprofile?exclude_topics=1&topic_short_name=".$topic->short_name));

            if($courseJson->social_link){
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

                        foreach($instructorJson as $instructor){
                            $instructor->id = $id;
                            $this->courseDetails->insertRow($instructor);
                        }

                    }
                }

            }
        }

        echo " done!";
    }

}