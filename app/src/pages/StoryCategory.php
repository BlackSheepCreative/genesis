<?php

use RyanPotter\SilverStripeColorField\Forms\ColorField;
use SilverStripe\Assets\Image;
use SilverStripe\Control\Session;
use SilverStripe\ORM\DataObject;

class StoryCategory extends DataObject
{

    private static $db = [
        'Title' => 'Varchar(200)',
        'SortOrder' => 'Int',
        'Colour' => 'Varchar(200)',
        'RGB' => 'Varchar(200)',
        'URLSegment' => 'Varchar(200)'
    ];

    private static $has_one = [
        'ColourIcon' => Image::class,
        'WhiteIcon' => Image::class,
    ];

    private static $has_many = [
        'StoryPages' => StoryPage::class,
    ];

    private static $owns = [
        'ColourIcon',
        'WhiteIcon'
    ];

    private static $many_many = [
        'StoryPageDisplays' => StoryPageDisplay::class,
    ];

    private static $default_sort = 'SortOrder ASC';

    public function Active()
    {
        $id = Session::get('ActiveCategory');
        return ($this->ID == $id);
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('SortOrder');

        $fields->dataFieldByName('ColourIcon')->setFolderName('Stories/StoryCategories');
        $fields->dataFieldByName('WhiteIcon')->setFolderName('Stories/StoryCategories');

        $fields->addFieldToTab('Root.Main', ColorField::create('Colour'), 'ColourIcon');
        return $fields;
    }

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        if (!empty($this->Colour)) {

            $hex = str_replace('#', '', $this->Colour);
            if (strlen($hex) == 3) {

                $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
                $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
                $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));

            } else {

                $r = hexdec(substr($hex, 0, 2));
                $g = hexdec(substr($hex, 2, 2));
                $b = hexdec(substr($hex, 4, 2));
            }
            $this->RGB = $r . ',' . $g . ',' . $b;

        }


    }
}