<?php

use SilverStripe\Control\Email\Email;
use SilverStripe\Control\Session;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;

class ContactForm extends Form
{

    static $allowed_actions = array('save');

    public function __construct($controller, $name)
    {

        $fields = new FieldList(
            TextField::create('Name'),
            EmailField::create('Email'),
            TextareaField::create('Message')
        );

        $actions = new FieldList(FormAction::create('ContactForm')->setTitle('ContactForm'));
        parent::__construct($controller, $name, $fields, $actions);

        $sess = Session::get('ContactForm');
        if (!empty($sess)) {
            $this->loadDataFrom(unserialize($sess));
        }

        if (isset($_GET['Error']) == FALSE) {

            Session::clear('ContactFormErrors');
        }
    }

    public function save($data)
    {

        Session::set('ContactForm', serialize($_POST));
        $errors = [];

        $required = [
            'Name' => 'Name',
            'Email' => 'Email',
            'Message' => 'Message',
        ];

        foreach ($required as $key => $value) {

            if (empty($_POST[$key])) {

                $errors[$key] = '"' . $value . '" is a required field.';
            }
        }

        if (!empty($errors)) {

            Session::set('ContactFormErrors', implode('<br>', $errors));
            $this->controller->redirect($this->controller->Link() . '?Error');
            return;
        }

        $this->_save_db();
        $this->_send_email();
        Session::clear('ContactForm');
        $this->clearMessage();
        $this->controller->redirect($this->controller->Link() . '?Success');
        return;
    }

    public function Errors()
    {
        return Session::get('ContactFormErrors');
    }

    public function Success()
    {

        return (isset($_GET['Success']));
    }

    private function _save_db()
    {

        $data = [];
        $post = $_POST;
        unset($post['g-recaptcha-response']);

        $data['Form'] = 'Contact';
        $data['Email'] = $post['Email'];
        $data['Data'] = serialize($post);
        $submission = new FormSubmission($data);
        $submission->write();
    }

    private function _send_email()
    {
        $post = $_POST;
        $post['Subject'] = 'Loyalty NZ contact form submission';
        $post['Message'] = nl2br($post['Message']);
        $from = 'forms@baa.co.nz';
        $admin = ($_SERVER['SERVER_ADMIN'] == 'dev@baa.co.nz') ? 'andrew@baa.co.nz' : $this->controller->AdminEmail;

        $email = new Email($from, $admin, $post['Subject'], '');
        $email->addCustomHeader('Reply-To', $from);
        $email->addCustomHeader('Bcc', 'forms@baa.co.nz');
        $email->setTemplate('ContactEmail');
        $email->populateTemplate($post);
        $email->send();
    }
}