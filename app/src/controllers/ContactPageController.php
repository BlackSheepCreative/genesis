<?php

class ContactPageController extends PageController
{

    private static $allowed_actions = ['Form'];

    public function Form()
    {
        return new ContactForm($this, 'Form/save');
    }
}
