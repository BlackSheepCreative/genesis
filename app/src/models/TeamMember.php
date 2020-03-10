<?php


namespace BSC\Models;

use App\Page\AboutPage;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class TeamMember extends DataObject
{
    private static $db = [
        "EmployeeName" => "Varchar(100)",
        "EmployeePosition" => "Varchar(100)",
        "EmployeeDescription" => "Varchar(100)",
        "SortOrder" => "Int"

    ];

    private static $has_one = [
        "Image" => Image::class,
        "AboutPage" => AboutPage::class
    ];

    private static $owns = [
        "Image"
    ];
    private static $summary_fields = [
        "EmployeeName"
    ];
    private static $table_name = "TeamMember";
    private static $default_sort = "SortOrder ASC";

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            "AboutPageID"
        ]);

        $fields->addFieldsToTab("Root.Main", [
            TextField::create("EmployeeName")->addExtraClass("stacked"),
            TextField::create("EmployeePosition")->addExtraClass("stacked"),
            TextField::create("EmployeeDescription")->addExtraClass("stacked"),
            UploadField::create("Image", "Image")
        ]);

        return $fields;
    }
}
