<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

class CustomSiteConfig extends DataExtension
{

    private static $db = [
        'GoogleAnalyticsCode' => 'Text',
        'GoogleAnalyticsDomain' => 'Text'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab('Root.Main', new TextField('GoogleAnalyticsCode', 'Google Analytics code (UA-XXXXXXXX-XX)'));
        $fields->addFieldToTab('Root.Main', new TextField('GoogleAnalyticsDomain', 'Google Analytics site domain (baa.co.nz NOT www.baa.co.nz)'));
    }
}