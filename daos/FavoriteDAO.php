<?php
    require_once 'models/User.php';
    require_once 'models/Rasehorse.php';
    require_once 'models/Favorite.php';
    
    class FavoriteDAO{
        // データベースと接続を行うメソッド
        public function get_connection(){
            $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
            return $pdo;
        }
        // データベースとの切断を行うメソッド
        public function close_connection($pdo, $stmp){
            $pdo = null;
            $stmp = null;
        }
        
        // いいねデータを1件登録するメソッド
        public function insert($favorite){
            $pdo = $this->get_connection();
            // INSERT文の実行準備
            $stmt = $pdo -> prepare("INSERT INTO favorites (user_id, racehorse_id) VALUES (:user_id, :racehorse_id)");
            // バインド処理
            $stmt->bindParam(':user_id', $favorite->user_id, PDO::PARAM_INT);
            $stmt->bindParam(':racehorse_id', $favorite->racehorse_id, PDO::PARAM_INT);

            // INSERT文本番実行
            $stmt->execute();
            
            $this->close_connection($pdo, $stmp);
        }
        
        // 注目しているユーザが注目している投稿にいいねをしているかを取得するメソッド
        public function check_favorite($user_id, $racehorse_id){
            $pdo = $this->get_connection();
            $stmt = $pdo->prepare('SELECT * FROM favorites WHERE user_id=:user_id AND racehorse_id=:racehorse_id');
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':racehorse_id', $racehorse_id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Favorite');
            $favorites = $stmt->fetchAll();
            $this->close_connection($pdo, $stmp);
            // var_dump(count($favorites));
        
            // いいねしていなければ
            if(count($favorites) === 0){
                return false;   
            }else{ //いいねしていれば
                return true;
            }
        }
        // 注目している投稿がいくついいねされているかをカウントするメソッド
        public function get_favorites_count($racehorse_id){
            $pdo = $this->get_connection();
            $stmt = $pdo->prepare('SELECT * FROM favorites WHERE racehorse_id = :racehorse_id');
            $stmt->bindParam(':racehorse_id', $racehorse_id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Favorite');
            $favorites = $stmt->fetchAll();
            $this->close_connection($pdo, $stmp);
            // いいね数を返す
            return count($favorites);
            
        }
        
    }