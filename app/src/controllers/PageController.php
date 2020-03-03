<?php

namespace {

    use SilverStripe\CMS\Controllers\ContentController;
    use SilverStripe\Control\Session;

    class PageController extends ContentController
    {

        private static $allowed_actions = ['storycategory', 'storypage'];

        public function init()
        {
            parent::init();
            Session::set('FixedImages', TRUE);
            // Session::set('CurrentLink', $this->Link());
        }
    }


}
