<?php

namespace Poll\Model;

use Poll\Model\Database;
use Poll\Model\AbstractModel;

class Option extends AbstractModel {

    private $id;
    private $name;
    private $votes;

    protected function assign($optionObj) {
        $this->id = $optionObj['id'];
        $this->name = $optionObj['name'];
        $this->votes = $optionObj['votes'];
    }

    public function set($optionObj){
        $this->assign($optionObj);
    }

    public function load($id) {
        $connection = Database::getConnection();
        $optionStatement = $connection->query("SELECT * FROM `poll_option` WHERE `id`='$id';");
        $optionObj = $optionStatement->fetch(\PDO::FETCH_ASSOC);
        if($optionObj) {
            $this->assign($optionObj);
            return $this;
        }
        else return null;
    }

    public function update(){
        $connection = Database::getConnection();
        $updatePollOptionStatement = $connection->prepare(
            "UPDATE `poll_option` SET `votes`=? WHERE `id`=?"
        );
        $updatePollOptionStatement->execute([$this->votes+1, $this->id]);
        $this->setVotes($this->votes+1);
        return $this;
    }

    public function save() {
        $connection = Database::getConnection();
        $insertPollOptionStatement = $connection->prepare(
            "INSERT INTO `poll_option` (`name`, `votes`) VALUES (?,?);"
        );
        $insertPollOptionStatement->execute([$this->name, $this->votes]);
        $lastOption = $connection->lastInsertId();
        return $this->load($lastOption);
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getVotes() {
        return $this->votes;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setVotes($votes) {
        $this->votes = $votes;
    }
}