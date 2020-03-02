<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\CheckboxSetField;

class StoryPageDisplay extends Page
{

    private static $db = [
        'DisplayPromoPages' => 'Boolean',
    ];
    private static $many_many = [
        'StoryCategories' => StoryCategory::class,
    ];
    private static $has_one = [
        'BannerImage' => Image::class,
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', UploadField::create('BannerImage'), 'Content');
        $fields->addFieldToTab('Root.Main', CheckboxField::create('DisplayPromoPages'), 'Content');
        $fields->addFieldToTab('Root.StoryCategory',
            CheckboxSetField::create('StoryCategories', 'StoryCategories', StoryCategory::get()->map('ID', 'Title'))
        );
        return $fields;
    }
}