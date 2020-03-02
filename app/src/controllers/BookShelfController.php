<?php

class BookShelfController extends PageController
{


    public function getStoryCategories()
    {
        return StoryCategory::get();
    }


    public function getStoryPages()
    {
        return StoryPage::get();
    }

    public function PromoPages()
    {
        return PromotionPage::get()->filter('CardShow', '1');
    }
}
