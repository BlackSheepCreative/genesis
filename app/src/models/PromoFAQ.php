<?php

use SilverStripe\ORM\DataObject;

class PromoFAQ extends DataObject
{
    private static $db = [
        'Title' => Text::class,
        'Content' => Text::class,
    ];
    private static $has_one = [
        'PromotionPage' => PromotionPage::class,
    ];
}