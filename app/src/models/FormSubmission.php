<?php

use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\DataObject;

class FormSubmission extends DataObject
{

    private static $db = [
        'Form' => 'Varchar(200)',
        'Email' => 'Varchar(200)',
        'Data' => 'HTMLText',
    ];

    private static $summary_fields = [
        'Form' => 'Form',
        'Email' => 'Email',
        'Created' => 'Created',
    ];

    public function DataTable()
    {

        $data = unserialize($this->Data);
        $html = [];
        $html[] = '<table>';
        foreach ($data as $key => $value) {
            $html[] = '<tr><td style="padding-right: 10px; white-space: nowrap; vertical-align: top;">' . $key . '</td><td style="padding-bottom: 10px;">' . $value . '</td></tr>';
        }
        $html[] = '</table>';
        return implode('', $html);
    }

    public function getCMSFields()
    {

        $fields = parent::getCMSFields();
        $fields->removeByName('Data');
        $fields->addFieldToTab('Root.Main', LiteralField::create('Data', $this->DataTable()));
        return $fields;
    }
}