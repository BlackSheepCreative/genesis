<?php

namespace App\Page;

use BSC\Models\Partner;
use BSC\Models\TeamMember;
use Page;

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;


class AboutPage extends Page
{
    private static $table_name = 'AboutPage';

    private static $db = [
        "Intro_title" => "Text",
        "Intro_body" => "Text",
        "Intro_body_description" => "Text",
        "Team_title" => "Text",
        "EmployeeName" => "Text",
        "EmployeePosition" => "Text"


    ];

    private static $has_one = [];

    private static $owns = [];
    private static $has_many = [
        "TeamMembers" => TeamMember::class,
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab("Root.Intro", [
            TextField::create("Intro_title", "Intro Title")->addExtraClass("stacked"),
            TextareaField::create("Intro_body", "Intro Body")->addExtraClass("stacked"),
            TextareaField::create("Intro_body_description", "Intro body description")->addExtraClass("stacked")
        ]);


        $fields->addFieldsToTab('Root.Team', [
            TextField::create("Team_title", "Team Title"),
            GridField::create("TeamMembers", "TeamMembers", $this->TeamMembers(), GridFieldConfig_RecordEditor::create())
        ]);


        return $fields;
    }
}