<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;

class StoryPage extends Page
{

    private static $show_in_sitetree = false;
    private static $allowed_children = [];

    private static $has_one = [
        'StoryCategory' => StoryCategory::class,
        'Image' => Image::class,

    ];

    private static $owns = [
        'Image'
    ];

    private static $db = [
        'Title' => 'Varchar(200)',
        'SubTitle' => 'Varchar(200)',
        'URLSegment' => 'Varchar(200)',
        'Publisher' => 'Varchar(200)',
        'PublishDate' => 'Date',
        'Priority' => 'Boolean',
        'Blurb' => 'Text',
        'Content' => 'HTMLText',
        'PriorityOrder' => 'Int',
        'PixelShouldShow' => 'Boolean'
    ];

    private static $summary_fields = [
        'Title' => 'Title',
        'Priority.Nice' => 'Priority'

    ];


    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Publisher', 'Publisher'),
            TextField::create('SubTitle', 'SubTitle'),
            CheckboxField::create('Priority', 'Featured Story'),
            TextField::create('PriorityOrder', 'Priority Order')->setDescription('The higher the number the more important the story'),
            DropdownField::create('StoryCategoryID', 'StoryCategory', StoryCategory::get()->map('ID', 'Title')),
            TextareaField::create('Blurb'),
            UploadField::create('Image', 'Image')->setFolderName('Stories/Story')
        ], 'Content');

        $field = new DateField('PublishDate', 'Publish Date');
        $field->setDescription('e.g. 23 Nov 2016');
        //$field->setAttribute('placeholder', $field->getConfig('dateformat'));
        $fields->addFieldToTab('Root.Main', $field, 'Priority');
        $fields->addFieldsToTab('Root.Main', [
            CheckboxField::create('PixelShouldShow')
        ], 'Content');

        $fields->removeByName('Metadata');
        $fields->removeByName('BannerImage');
        return $fields;
    }


    public function ParsedContent()
    {
        $html = $this->obj('Content')->forTemplate();
        $html = str_replace(["\r", "\n"], '', $html);
        preg_match_all('/<p>.*?<\/p>/i', $html, $paras);
        $found = FALSE;
        if (count($paras[0]) > 0) {
            foreach ($paras[0] as $para) {
                if ($found == FALSE) {
                    $content = trim(preg_replace('/&[A-Za-z0-9]+;/i', ''
                        , htmlentities(strip_tags($para))));
                    if (!empty($content)) {
//                        $new_para = str_replace('<p>','<p class="leading">',$para);
//                        $html = str_replace($para,$new_para,$html);
                        $found = TRUE;

                    }
                }
            }
        }
        preg_match_all('/<table.*?>.*?(<address>.*?<\/address>)(.*?)<\/table>/i', $html, $captions);

        foreach ($captions[0] as $i => $table) {
            $new_table = str_replace('<address', '<address class="left"', $captions[1][$i]);
            $new_table .= str_replace(['<td>', '</td>', '</tr>', '</tbody>'], '', $captions[2][$i]);
            $html = str_replace($table, $new_table, $html);
        }
        return $html;
    }


    public function Panel()
    {
        return $this->renderWith('StoryPageCard')->forTemplate();
    }

    public function PanelImage()
    {
        $parts = explode('.', $this->Image()->Name);
        $extension = strtolower(array_pop($parts));

        switch ($extension) {
            case 'gif':
                return $this->Image();
                break;
            default:
                return $this->Image()->ScaleWidth(340);
                break;
        }
    }

    public function CategoryLink()
    {
        return $this->parent()->Link() . '#' . $this->StoryCategory()->URLSegment;
    }

    public function FacebookLink()
    {
        return 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode('http://' . $_SERVER['HTTP_HOST'] . preg_replace('/^(.*?)\?.*$/i', '$1', $_SERVER['REQUEST_URI']));
    }

    public function TwitterLink()
    {
        return 'https://twitter.com/home?status=' . urlencode('http://' . $_SERVER['HTTP_HOST'] . preg_replace('/^(.*?)\?.*$/i', '$1', $_SERVER['REQUEST_URI']));
    }

    public function LinkedInLink()
    {
        return 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode('http://' . $_SERVER['HTTP_HOST'] . preg_replace('/^(.*?)\?.*$/i', '$1', $_SERVER['REQUEST_URI'])) . '&title=&summary=&source=';
    }

    public function EmailLink()
    {
        return 'mailto:?&subject=See this story on Loyalty NZ&body=' . urlencode('http://' . $_SERVER['HTTP_HOST'] . preg_replace('/^(.*?)\?.*$/i', '$1', $_SERVER['REQUEST_URI']));
    }

    public function RelatedStories()
    {
        return StoryPage::get()->filter('StoryCategoryID', $this->StoryCategoryID)->exclude('ID', $this->ID)->limit(3);
    }

}
