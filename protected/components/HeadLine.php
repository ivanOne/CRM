<?php

class HeadLine extends CWidget{
    public $html = null;
    public $addClass = "";
    public function init()
    {
        parent::init();
    }

    public function run(){
        if($this->html != null){
            echo "<div class='col-lg-10 col-lg-offset-2 ".$this->addClass."'>";
            echo $this->html;
            echo "</div>";
        }
    }

} 