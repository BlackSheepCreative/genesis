<?php

use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;

class CustomerReason extends DataObject
{
    private static $db = [
        'Title' => 'Text',
        'Blurb' => 'Text',
        'Subnote' => 'Text'
    ];

    private static $has_one = [
        'Photo' => Image::class,
        'PromotionPage' => PromotionPage::class
    ];

    private static $owns = [
        'Photo'
    ];
}

