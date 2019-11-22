<?php
    require 'bdd.php';
    // セッション開始
    session_start();
    $session_id = session_id();
    if (!empty($_POST['logout'])){
        // セッションの変数のクリア
    $_SESSION = array();

    // セッションクリア
    session_destroy();
    }	

    if (isset($_SESSION["ID"])) {
        header("Location: ../index.php");
        exit;
    }
    
    if( isset( $_POST["id"] , $_POST["password"] )==true && 
        is_have($_POST["id"])===true && 
        challenge_update($_POST["id"], session_id())===true && 
        challenge($_POST["id"] , $_POST["password"]))
    {
        echo "kuria-";
    //    header('Location: home.php');  // メイン画面へ遷移
    //    exit();  // 処理終了
    }else{
        echo "desutoroi";
    //    destroy();
     //   header('Location: login_id.php');  // メイン画面へ遷移
    //    exit();  // 処理終了
    }

    function destroy(){
        require 'bdd.php';
        $stmt = $bdd->prepare("DELETE FROM users_sessions WHERE id = ?");
        $stmt->execute(array(session_id()));  
        session_destroy();
    }

    function is_have($user_id){
        require 'bdd.php';
        $stmt = $bdd->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute(array($user_id));

        $cntent =$stmt->rowCount();

        if($cntent != '0'){
            return true;
        }else{
            return false;
        }
    }

    function challenge_update($user_id, $id){  
        try {
            require 'bdd.php';
            $stmt = $bdd->prepare("UPDATE users_sessions SET user_id = ? WHERE id = ? ");
            $stmt->execute(array($user_id, $id));  
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    function challenge($user_id, $challenger){
        require 'bdd.php';
        $password="";
        $stmt = $bdd->prepare('SELECT * FROM users INNER JOIN users_sessions ON users.id = users_sessions.user_id WHERE users.id = ?');
        $stmt->execute(array($user_id));

        foreach($stmt as $row){
            $password=$row['password'].$row['challenge'];
            echo $row['password']."<br />";  
            echo $row['challenge']."<br />";  
            echo $password."<br />";  
        }
        echo hash('sha256', $password)."<br />"; 
        echo $challenger."<br />";  
        
        if(hash('sha256', $password) === $challenger){
            return true;
        }else{
            return false;
        }
    }

    ?>