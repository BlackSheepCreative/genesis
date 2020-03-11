<?php

namespace App\Page;

use BSC\Models\Award;
use BSC\Models\BoardMember;
use BSC\Models\Shareholder;
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
        "Board_title" => "Text",
        "Board_description" => "Text",
        "Shareholders_title" => "Text",
        "Shareholders_description" => "Text",
        "Awards_title" => "Text",
        "Awards_description" => "Text"


    ];

    private static $has_one = [];

    private static $owns = [];
    private static $has_many = [
        "TeamMembers" => TeamMember::class,
        "BoardMembers" => BoardMember::class,
        "Shareholders" => Shareholder::class,
        "Awards" => Award::class,

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

        $fields->addFieldsToTab("Root.Board", [
            TextField::create("Board_title", "Board Title")->addExtraClass("stacked"),
            TextareaField::create("Board_description", "Board Description")->addExtraClass("stacked"),
            GridField::create("BoardMember", "BoardMembers", $this->BoardMembers(), GridFieldConfig_RecordEditor::create())
        ]);

        $fields->addFieldsToTab("Root.Shareholders", [
            TextField::create("Shareholders_title", "Shareholders Title")->addExtraClass("stacked"),
            TextareaField::create("Shareholders_description", "Shareholders description")->addExtraClass("stacked"),
            GridField::create("Shareholder", "Shareholders", $this->Shareholders(), GridFieldConfig_RecordEditor::create())
        ]);

        $fields->addFieldsToTab("Root.Award", [
            TextField::create("Awards_title", "Award Title")->addExtraClass("stacked"),
            TextareaField::create("Awards_description", "Award Description")->addExtraClass("stacked"),
            GridField::create("Award", "Awards", $this->Awards(), GridFieldConfig_RecordEditor::create())
        ]);


        return $fields;
    }
}