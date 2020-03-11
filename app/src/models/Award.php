<?php


namespace BSC\Models;

use App\Page\AboutPage;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class Award extends DataObject
{
    private static $db = [
        "AwardName" => "Varchar(100)",
        "AwardPosition" => "Varchar(100)",
        "AwardInfoDescription" => "Varchar(100)",
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
        "AwardName"
    ];
    private static $table_name = "Award";
    private static $default_sort = "SortOrder ASC";

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            "AboutPageID"
        ]);

        $fields->addFieldsToTab("Root.Main", [
            TextField::create("AwardName")->addExtraClass("stacked"),
            TextField::create("AwardPosition")->addExtraClass("stacked"),
            TextareaField::create("AwardInfoDescription")->addExtraClass("stacked"),
            UploadField::create("Image", "Image")
        ]);

        return $fields;
    }
}
