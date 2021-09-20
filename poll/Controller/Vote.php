<?php

namespace Poll\Controller;

use Poll\Model\Option;

class Vote {

    public function execute(){
        $optionId = $this->getPostOptionId();
        $option = new Option();
        $option = $option->load($optionId);
        $option->update();
        return true;
    }

    private function getPostOptionId(){
        return $_POST['option_id'];
    }
}