<?php

class CronTasks extends CI_Controller {

    function scrape_coursera(){
        echo "scraping coursera....";

        $urls = (object) array("coursesJson" => "https://d1hpa2gdx2lr6r.cloudfront.net/maestro/api/topic/list2");

        $coursesJson = json_decode(file_get_contents($urls->coursesJson));

        $topics = $coursesJson->topics;

        foreach($topics as $topic){
            echo $topic->short_name;
            echo "<br/>";
        }
    }

}