<?php

//namespace App\Controllers;
//
//use PageController;

use SilverStripe\Control\Session;

class HomePageController extends PageController
{

    private static $allowed_actions = [];

    public function init()
    {
        parent::init();
        Session::set('FixedImages', FALSE);
    }

    public function isHome()
    {
        return true;
    }

    public function StoryPages()
    {

        $ids = [];

        foreach ($this->StoryCategories() as $category) {
            $ids[] = $category->ID;
        }

        return StoryPage::get()
            ->where('StoryCategoryID IN (' . implode(', ', $ids) . ')')
            ->where('DisplayOrder = 0')
            ->sort('RAND()');
    }

    public function getOrderedStories()
    {
        $ids = [];

        foreach ($this->StoryCategories() as $category) {
            $ids[] = $category->ID;
        }

        return StoryPage::get()
            ->where('StoryCategoryID IN (' . implode(', ', $ids) . ')')
            ->where('DisplayOrder != 0');
        //->sort('RAND()');
    }
}