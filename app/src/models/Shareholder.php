<?php


namespace BSC\Models;

use App\Page\AboutPage;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class Shareholder extends DataObject
{
    private static $db = [
        "ShareholderName" => "Varchar(100)",
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
        "ShareholderName"
    ];
    private static $table_name = "Shareholder";
    private static $default_sort = "SortOrder ASC";

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            "AboutPageID"
        ]);

        $fields->addFieldsToTab("Root.Main", [
            TextField::create("ShareholderName")->addExtraClass("stacked"),
            UploadField::create("Image", "Image")
        ]);

        return $fields;
    }
}
