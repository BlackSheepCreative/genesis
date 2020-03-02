<?php

use SilverStripe\Admin\ModelAdmin;

class StoryCategoryAdmin extends ModelAdmin
{
    static $managed_models = [
        'StoryCategory',
    ];
    static $url_segment = 'storycategory';
}