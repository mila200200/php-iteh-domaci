<?php

class Tip{
  public $tipId;
  public $nazivTipa;
  function __construct($tipId=null,$nazivTipa=null) {
        $this->tipId = $tipId;
        $this->nazivTipa = $nazivTipa;
    }
   
}
?>