<?php

namespace {

    use SilverStripe\AssetAdmin\Forms\UploadField;
    use SilverStripe\Assets\Image;
    use SilverStripe\CMS\Model\SiteTree;
    use SilverStripe\Forms\TextareaField;


    class Page extends SiteTree
    {

        private static $db = [
            'BannerTitle' => 'Varchar(200)',
        ];

        private static $has_one = [
            'BannerImage' => Image::class,
        ];

        private static $owns = [
            'BannerImage'
        ];


        public function getCMSFields()
        {
            $fields = parent::getCMSFields();
            $fields->addFieldToTab('Root.Main', TextareaField::create('BannerTitle'), 'Content');
            $fields->addFieldToTab('Root.Main', UploadField::create('BannerImage')->setFolderName('BannerImages'), 'Content');
            return $fields;
        }
    }
}
