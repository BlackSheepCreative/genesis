<?php

use SilverStripe\Admin\ModelAdmin;
use SilverStripe\Security\Permission;

class FormsAdmin extends ModelAdmin
{

    static $managed_models = [
        'FormSubmission',
    ];
    static $url_segment = 'forms';
    static $menu_title = 'Forms';

    public function canView($member = null)
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canEdit($member = null)
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canDelete($member = null)
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canCreate($member = null)
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }
}