<?php
    require_once 'daos/FavoriteDAO.php';
    session_start();
    
    $user_id = $_SESSION['user_id'];
    $racehorse_id = $_POST['racehorse_id'];

    $favorite = new Favorite($user_id, $racehorse_id);
    
    $favorite_dao = new FavoriteDAO();
    
    
    $favorite_dao->insert($favorite);
    $favorite = $favorite_dao->check_favorite($user_id, $racehorse_id);
    
    $_SESSION['flash_message'] = 'いいねを追加しました';
    header('Location: mypage.php');
    exit;