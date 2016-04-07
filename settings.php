<?php

class Settings extends Calculator{

    public function get(){
        return [
            "infinity" => true,
            "loops" => 4,
            "pause_before_exit" => 5
        ];
    }
}
