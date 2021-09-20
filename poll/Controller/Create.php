<?php

namespace Poll\Controller;

use \Poll\Model\Poll;
use \Poll\Model\Option;

class Create {

    public function createPoll(){
        if($this->validatePostData()){
            $currentDate = date('Y-m-d H:i:s');
            $title = $this->getPollTitle();
            $options = $this->getPollOptions();
            $days = $this->getDays();
            $dueDate = date('Y-m-d H:i:s', strtotime($currentDate . ' + ' . $days . ' days'));
    
            $poll = new Poll();
            $poll->setTitle($title);
            $poll->setDateCreated($currentDate);
            $poll->setDueDate($dueDate);

            $hash = hash('adler32', $currentDate);
            $poll->setHash($hash);
            
            foreach($options as $option){
                $pollOption = new Option();
                $pollOption->setName($option);
                $pollOption->setVotes(0);
                $poll->addOption($pollOption);
            }
            $newPoll = $poll->save();
            return $newPoll->getHash();
        }
        else {
            return null;
        }
    }

    private function getPollTitle(){
        return strip_tags($_POST['title']);
    }

    private function getPollOptions(){
        $options = array_map('strip_tags', $_POST['option']);
        return $options;
    }

    private function getDays(){
        return $_POST['days'];
    }

    private function validatePostData(){
        if(empty($_POST['title']) || empty($_POST['option']) || empty($_POST['days'])){
            return false;
        }
        else return true;
    }
}