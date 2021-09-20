<?php

namespace Poll\Model;

abstract class AbstractModel {

    abstract protected function load($id);
    abstract protected function save();
    abstract protected function assign($obj);
}