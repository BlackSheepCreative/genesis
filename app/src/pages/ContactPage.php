<?php

use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

class ContactPage extends Page
{

    private static $db = [
        'ColumnContent' => 'HTMLText',
    ];

    public function getCMSFields()
    {

        $fields = parent::getCMSFields();
        $fields->removeByName('Categories');
        $fields->addFieldToTab('Root.Main', HtmlEditorField::create('ColumnContent'), 'Metadata');
        return $fields;
    }
}