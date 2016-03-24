<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



class Timetable extends CI_Model{
    //top structures
    protected $xml = null;
    protected $day = array();
    protected $time = array();
    protected $course = array();
    protected $detail = array();
    protected $instructor = '';
    protected $room = null; //optional
    protected $by_day = array();
    protected $by_time = array();
    protected $by_course = array();

    
    public function __construct($filename = null) {
        parent::__construct();
        if ($filename == null){
            return;
        }
        //generating view for each facet
        $this->xml = simplexml_load_file(DATAPATH. 'schedule.xml');
        $this->facetDay();
        $this->facetTime();
        $this->facetCourse();
    }
    
    function facetDay(){
        // extract all the elements
//        foreach($this->xml->schedule->by_day->book_day as $book){
//            $record = new stdClass();
//            $record->day = (string) $book['day'];
//            foreach($book->content as $class){
//                $record->time = (string) $class->class_time['time'];
//                $record->number = (string) $class->course['number'];
//                $record->instructor = (string) $class->detail['instructor']; 
//                $record->room = (string) $class->detail['room'];
//            }
//            $this->by_day[$record->day] = $record;
//        }
        foreach($this->xml->by_day->book_day as $book){
            foreach($book->time_of_day as $content){
                //creating each item for the view
                $time = $content->class_time;
                $course = $content->the_course;
                $detail = $content->detail;
                //putting content to booking
                $this->by_day[] = new Booking($detail,$book,$time,$course);
            }
            
        }
    }
    
    function facetTime(){
//        foreach($this->xml->schedule->by_time->book_time as $book){
//            $record = new stdClass();
//            $record->time = (string) $book['time'];
//            foreach($book->content as $class){
//                $record->day = (string) $class->week_day['day'];
//                $record->number = (string) $class->course['number'];
//                $record->instructor = (string) $class->detail['instructor']; 
//                $record->room = (string) $class->detail['room'];
//            }
//            $this->by_time[$record->time] = $record;
//        }
        foreach($this->xml->by_time->book_time as $book){
            foreach($book->day_of_week as $content){
                //creating each item for the view
                $course = $content->course;
                $day = $content->week_day;
                $detail  = $content->detail; 
                //putting content to booking
                $this->by_time[] = new Booking($detail,$day,$book,$course);
            }
            
        }
    }
    
    function facetCourse(){
//        foreach($this->xml->schedule->by_course->book_course as $book){
//            $record = new stdClass();
//            $record->number = (string) $book['number'];
//            foreach($book->content as $class){
//                $record->day = (string) $class->week_day['day'];
//                $record->number = (string) $class->blocks['number'];
//                $record->instructor = (string) $class->detail['instructor']; 
//                $record->room = (string) $class->detail['room'];
//            }
//            $this->by_time[$record->time] = $record;
//        }
        foreach($this->xml->by_course->book_course as $book){
            foreach($book->time_block as $content){
                //creating each item for the view
                $day = $content->this_week;
                $time = $content->blocks;
                $detail  = $content->detail;
                //putting content to booking
                $this->by_course[] = new Booking($detail,$day,$time,$book);
            }
            
        }
    }
    
    // set of getters for each item
    function byDay(){
        return $this->by_day;
    }
    
    function getByDay($input){
        if (isset($this->by_day[$input])) {
            return $this->by_day[$input];
        }
        else{
            return null;
        }
    }
    
    function byTime(){
        return $this->by_time;
    }
    
    function getByTime($input){
        if (isset($this->by_time[$input])) {
            return $this->by_time[$input];
        }
        else{
            return null;
        }
    }
    
    function byCourse(){
        return $this->by_course;
    }
    
    function getByCourse($input){
        if (isset($this->by_course[$input])) {
            return $this->by_course[$input];
        }
        else{
            return null;
        }
    }
}

class Booking{ 

    public function __construct($content,$day,$time,$course) {
        
        //building the content
        $this->day = (string) $day['day'];
        $this->time = (string) $time['time'];
        $this->course = (string) $course['number'];
        $this->instructor = (string) $content['instructor'];
        $this->room = (string) (isset($content['room']))?(string) $content['room'] : null;
    }
}
