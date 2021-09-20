<?php

namespace Poll\Model;

use Poll\Model\Database;
use Poll\Model\AbstractModel;
use Poll\Model\Option;

class Poll extends AbstractModel {

    private $id;
    private $title;
    private $dateCreated;
    private $dueDate;
    private $hash;
    private $options;

    protected function assign($pollObj){
        $this->id = $pollObj['id'];
        $this->title = $pollObj['title'];
        $this->dateCreated = $pollObj['date_created'];
        $this->dueDate = $pollObj['due_date'];
        $this->hash = $pollObj['hash'];
    }

    public function load($id) {
        $connection = Database::getConnection();
        $pollStatement = $connection->query("SELECT * FROM `poll` WHERE `id`='$id';");
        $pollObj = $pollStatement->fetch(\PDO::FETCH_ASSOC);
        if($pollObj){
            $this->assign($pollObj);
            return $this;
        }
        else return null;
    }

    public function loadByHash($hash){
        $connection = Database::getConnection();
        $pollStatement = $connection->query("SELECT * FROM `poll` WHERE `hash`='$hash';");
        $pollObj = $pollStatement->fetch(\PDO::FETCH_ASSOC);
        if($pollObj){
            $this->assign($pollObj);
            return $this;
        }
        else return null;
    }

    public function save() {
        $connection = Database::getConnection();
        $insertPollStatement = $connection->prepare(
            "INSERT INTO `poll` (`title`, `date_created`, `due_date`, `hash`) VALUES (?,?,?,?);"
        );
        $insertPollStatement->execute([$this->title, $this->dateCreated, $this->dueDate, $this->hash]);
        $lastPoll = $connection->lastInsertId();

        $relatedRows = [];
        foreach($this->options as $option){
            $savedOption = $option->save();
            $this->addOption($savedOption);
            $relatedRows[] = ["'" . $lastPoll . "'", "'" . $savedOption->getId() . "'"];
        }

        $rows = [];
        foreach($relatedRows as $relatedRow){
            $rows[] = '(' . implode(', ', $relatedRow) . ')';
        }
        $rows = implode(',', $rows);

        $connection->query("INSERT INTO `poll_option_index` (`poll_id`, `poll_option_id`) VALUES $rows;");
        return $this->load($lastPoll);
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDateCreated() {
        return $this->dateCreated;
    }

    public function getDueDate() {
        return $this->dueDate;
    }

    public function getHash() {
        return $this->hash;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    public function setDueDate($dueDate) {
        $this->dueDate = $dueDate;
    }

    public function isActive(){
        $todayDate = date('Y-m-d H:i:s');
        $dueDate = $this->getDueDate();

        $today = new \DateTime($todayDate);
        $due = new \DateTime($dueDate);

        return $today < $due;
    }

    public function setHash($hash) {
        $this->hash = $hash;
    }

    public function getOptions(){
        $connection = Database::getConnection();
        $optionStatement = $connection->query("SELECT poll_option_id FROM `poll_option_index` WHERE `poll_id`=$this->id;");
        $optionResults = $optionStatement->fetchAll(\PDO::FETCH_ASSOC);
        if($optionResults){
            foreach($optionResults as $optionResult){
                $option = new Option();
                $option = $option->load($optionResult['poll_option_id']);
                $this->options[] = $option;
            }
            return $this->options;
        }
        return null;;
    }

    public function addOption($option){
        $this->options[] = $option;
    }
}