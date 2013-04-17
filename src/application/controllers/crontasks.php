<?php
class CronTasks extends CI_Controller {

    function scrape_coursera(){

        set_time_limit(600);

        $this->load->model("course_data");
        $this->load->model("courseDetails");
        echo "scraping coursera....";

        $urls = (object) array("coursesJson" => "https://d1hpa2gdx2lr6r.cloudfront.net/maestro/api/topic/list2");

        $coursesJson = json_decode(file_get_contents($urls->coursesJson));

        $topics = $coursesJson->topics;

        foreach($topics as $topic){
            $courseJson = json_decode(file_get_contents("https://www.coursera.org/maestro/api/topic/information?topic-id=".$topic->short_name));
            $instructorJson = json_decode(file_get_contents("https://www.coursera.org/maestro/api/user/instructorprofile?exclude_topics=1&topic_short_name=".$topic->short_name));


            $catStr = "";
            foreach($courseJson->categories as $cat){
                if($catStr == ""){
                    $catStr .= $cat->name;
                }else{
                    $catStr .= ", ".$cat->name;
                }
            }

            $courseJson->category = $catStr;

            if($courseJson->video == ""){
                $courseJson->video_link = "";
            }else{
                $courseJson->video_link = "http://www.youtube.com/watch?v=".$courseJson->video;
            }


            foreach($courseJson->courses as $course){
                if($course->start_year){
                    $courseJson->start_date = $course->start_year."-".str_pad($course->start_month,2,'0', STR_PAD_LEFT)."-".str_pad($course->start_day,2,'0', STR_PAD_LEFT);
                    $courseJson->course_length = $course->duration_string;
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

}