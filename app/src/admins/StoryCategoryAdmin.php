<?php

use SilverStripe\Admin\ModelAdmin;

class StoryCategoryAdmin extends ModelAdmin
{
    private static $managed_models = [
        StoryCategory::class
    ];
    private static $url_segment = 'storycategory';
}