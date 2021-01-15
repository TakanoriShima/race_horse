<?php
    require_once 'daos/RacehorseDAO.php';
    require_once 'daos/FavoriteDAO.php';
    
    //レース投稿　一件分の投稿のデータを格納するクラス　DTO
    class Racehorse {
        public $id;
        public $user_id;
        public $racehorse_name;
        public $jockey_name;
        public $racecourse;
        public $race_name;
        public $content;
        
        public function __construct($user_id="", $racehorse_name="", $jockey_name="", $racecourse="", $race_name="", $content=""){
            $this->user_id = $user_id;
            $this->racehorse_name = $racehorse_name;
            $this->jockey_name = $jockey_name;
            $this->racecourse = $racecourse;
            $this->race_name = $race_name;
            $this->content = $content;
        }
        
        // 投稿したユーザを取得するメソッド
        public function get_user(){
            $racehorse_dao = new RacehorseDAO();
            $user = $racehorse_dao->get_user($this->id);
            return $user;
        }
        
        // 注目しているユーザがいいねしているかチェックするメソッド
        public function check_favorite($user_id){
            $favorite_dao = new FavoriteDAO();
            return $favorite_dao->check_favorite($user_id, $this->id);
        }
        
        // いいねの数をカウントするメソッド
        public function get_favorites_count(){
            $favorite_dao = new FavoriteDAO();
            return $favorite_dao->get_favorites_count($this->id);
        }
    }