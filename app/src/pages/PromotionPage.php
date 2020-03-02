<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\TextField;

class PromotionPage extends Page
{
    private static $db = [
        'CardTitle' => 'Text',
        'CardSubtitle' => 'Text',
        'CardBlurb' => 'Text',
        'CardShow' => 'Boolean',
        'VideoLink1' => 'Text',
        'VideoLink2' => 'Text',
    ];

    private static $has_one = [
        'BannerMobile' => Image::class,
        'BannerTablet' => Image::class,
        'BannerTabletLandscape' => Image::class,
        'BannerDesktop' => Image::class,
        'CardPhoto' => Image::class,
        'Image1' => Image::class,
        'Image2' => Image::class
    ];

    private static $has_many = [
        'CustomerReasons' => CustomerReason::class,
        'BusinessReasons' => BusinessReason::class,
        'PromoFAQs' => PromoFAQ::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('BannerImage');

        $fields->addFieldsToTab('Root.Banner', array(
            UploadField::create('BannerMobile')->setFolderName('promo-banner'),
            UploadField::create('BannerTablet')->setFolderName('promo-banner'),
            UploadField::create('BannerTabletLandscape')->setFolderName('promo-banner'),
            UploadField::create('BannerDesktop')->setFolderName('promo-banner')
        ));

        $fields->addFieldsToTab('Root.Card', array(
            TextField::create('CardTitle', 'Title'),
            TextField::create('CardSubtitle', 'Sub Title'),
            TextField::create('CardBlurb', 'Blurb'),
            CheckboxField::create('CardShow', 'Show'),
            UploadField::create('CardPhoto')->setFolderName('promo-photo')
        ));
        $fields->addFieldsToTab('Root.VideoSection', array(
            TextField::create('VideoLink1')->setDescription('Just the video id from youtube'),
            UploadField::create('Image1')->setDescription('Image to use instead of video'),
            TextField::create('VideoLink2')->setDescription('Just the video id from youtube'),
            UploadField::create('Image2')->setDescription('Image to use instead of video')
        ));

        $fields->addFieldsToTab('Root.CustomerReasons', [
            GridField::create(
                'CustomerReason',
                'CustomerReasons',
                $this->CustomerReasons(),
                GridFieldConfig_RecordEditor::create())
        ]);

        $fields->addFieldsToTab('Root.BusinessReasons', [
            GridField::create(
                'BusinessReason',
                'BusinessReasons',
                $this->BusinessReasons(),
                GridFieldConfig_RecordEditor::create())
        ]);

        $fields->addFieldsToTab('Root.FAQ', [
            GridField::create(
                'PromoFAQ',
                'PromoFAQs',
                $this->PromoFAQs(),
                GridFieldConfig_RecordEditor::create())
        ]);

        return $fields;
    }
}