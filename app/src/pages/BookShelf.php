<?php

use SilverStripe\Lumberjack\Forms\GridFieldConfig_Lumberjack;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

class BookShelf extends Page
{

    private static $allowed_children = [
        StoryPage::class,
    ];

    public function getLumberjackGridFieldConfig()
    {
        return GridFieldConfig_Lumberjack::create()->addComponent(new GridFieldSortableRows("Sort"));
    }

    public function getStories()
    {
        return $this->Children();
    }


}