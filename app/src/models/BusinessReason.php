<?php

use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;

class BusinessReason extends DataObject
{
    private static $db = [
        'Title' => Text::class,
        'Blurb' => Text::class,
        'Subnote' => Text::class
    ];

    private static $has_one = [
        'Photo' => Image::class,
        'PromotionPage' => PromotionPage::class
    ];
}