<?php

use SilverStripe\ORM\DataObject;

class PromoFAQ extends DataObject
{
    private static $db = [
        'Title' => 'Text',
        'Content' => 'Text',
    ];
    private static $has_one = [
        'PromotionPage' => PromotionPage::class,
    ];
}