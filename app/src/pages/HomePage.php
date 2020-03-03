<?php

//namespace App\Pages;
//
//use App\Controllers\HomePageController;
//use Page;

class HomePage extends Page
{

    public function canCreate($member = null)
    {
        return false;
    }
}