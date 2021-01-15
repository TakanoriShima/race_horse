<?php
    class Favorite{
        public $id;
        public $user_id;
        public $racehorse_id;
        public $created_at;
        public function __construct($user_id="", $racehorse_id=""){
            $this->user_id = $user_id;
            $this->racehorse_id = $racehorse_id;
        }
        
    }