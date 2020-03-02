<?php

use SilverStripe\Versioned\Versioned;

class StoryPageDisplayController extends PageController
{

    public function getStoryPages()
    {
        $cat_ids = array();
        foreach ($this->StoryCategories() as $category) {
            $cat_ids[$category->ID] = $category->ID;
        }
        return Versioned::get_by_stage('StoryPage', 'Live')->filter(array('StoryCategoryID' => $cat_ids,))->sort(array('Priority' => 'DESC', 'PriorityOrder' => 'DESC', 'ID' => 'DESC'));
        // return StoryPage_Live::get()->filter('StoryCategoryID', $cat_ids)->sort(array('Priority' => 'DESC','PriorityOrder' => 'DESC',  'ID' => 'DESC'));

    }

    public function PromoPages()
    {
        return PromotionPage::get()->filter('CardShow', '1');
    }
}