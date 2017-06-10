<?php

class Paginate{

    public $current_page;
    public $items_per_page;
    public $items_total_count;

    public function __construct($page=1, $items_per_page=4, $items_total_count=0){

        $this ->current_page = (int)$page;
        $this ->items_per_page = (int)$items_per_page;
        $this ->items_total_count = (int)$items_total_count;
    }//this func automatically calls when this class is called

    public function next(){

        return $this ->current_page + 1;
        //+1 is because we can go up the page
    }//this method is used for going next page

    public function previous(){

        return $this ->current_page - 1;
        //+1 is because we can go back the page
    }//this method is used for going previous page

    public function page_total(){

        return ceil($this ->items_total_count / $this ->items_per_page);
        //The ceil() function rounds a number UP to the nearest integer, if necessary
        //$items_total_count = Photo::count_all();
        //$items_total_count divide by $items_per_page gives us total no. of pages
    }//how many pages totally

    public function has_previous(){

        return $this ->previous() >= 1 ? true : false;
        //if our previous page is more or equal to one then return true else false
    }//if page has any previous pages

    public function has_next(){

        return $this ->next() <= $this ->page_total() ? true : false;
        //if our previous page is less or equal to page total then return true else false
    }//if page has any next pages

    public function offset(){

        return ($this ->current_page - 1) * $this ->items_per_page;
        //current_page is set to 0 by default multiplied with items_per_page gives offset
    }//skipping pages
}