<?php

use SilverStripe\Control\RequestHandler;

class StoryPageController extends PageController
{

    public static $allowed_actions = [
        'json'
    ];

    public function json()
    {

        $data = [];
        $data['CurrentStory'] = $this;

        $request = RequestHandler::getRequest();


        if ($request->getVar('ajax')) {

            $story = $data['CurrentStory']->toMap();
            $story['Content'] = $this->ParsedContent();
//            $story['Content'] = $this->Content();
            $story['StoryCategory'] = $this->StoryCategory()->toMap();
            $story['StoryCategoryLink'] = $this->parent()->Link() . '#' . $this->StoryCategory()->URLSegment;
            $story['CategoryIcon'] = (!empty($this->StoryCategory()->ColourIconID)) ? $this->StoryCategory()->ColourIcon()->SetRatioSize(27, 27)->Link() : FALSE;
            $story['PanelImage'] = (!empty($this->ImageID)) ? $this->PanelImage()->Link() : FALSE;
            $story['RelatedStories'] = [];
            $story['RelatedStories'] = [];
            $story['PublishDate'] = (!empty($story['PublishDate'])) ? date('jS F Y', strtotime($story['PublishDate'])) : FALSE;
            $story['FacebookLink'] = $this->FacebookLink();
            $story['TwitterLink'] = $this->TwitterLink();
            $story['LinkedInLink'] = $this->LinkedInLink();
            $story['EmailLink'] = $this->EmailLink();
            foreach ($this->RelatedStories() as $rs) {
                $rs_map = $rs->toMap();
                $rs_map['Panel'] = $rs->Panel();
                $story['RelatedStories'][] = $rs_map;
            }
            return json_encode($story);
        }

        return $this->redirect($this->Link());
    }
}