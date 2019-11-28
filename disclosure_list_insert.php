<?php
    require 'bdd.php';
    session_start();
    //セッション開始
    // ログイン状態チェック
    if (!isset($_SESSION["user_id"])) {
        header("Location: index.php");
        exit;
    }

    if( isset( $_POST["user_id"], $_POST["list_name"], $_POST["list_icon"], $_POST["is_publish"] )==true ){
        
        if(idCheck()==true && mailCheck()==true && passwordCheck()==true){
            //id_generator($_POST["id"]);
             insert();
        }
    }
    function insert(){
        require 'bdd.php';
        // 入力したユーザIDとパスワードの格納
        //$user_id = $str;
        $id = $_POST["id"];
        $password = $_POST["password"];
        $mailaddress = $_POST["email"];
       // $user_id = "hishida";
     //   $password = "hishida1";
     //   $mailaddress = "tatsuki1@live.jp";

        // エラー処理
        try {
            $id_result = "SELECT * FROM users WHERE id ='$id'";
                $id_stmt = $bdd->prepare($id_result);
                $id_stmt->execute();
                $id_count=$id_stmt->rowCount();
            $mail_result = "SELECT * FROM users WHERE e_mail ='$mailaddress'";
                $mail_stmt = $bdd->prepare($mail_result);
                $mail_stmt->execute();
                $mail_count=$mail_stmt->rowCount();
            if($id_count>=1 && $mail_count>1){
               echo 'IDもしくはメールアドレスが重複しています。';
            }else{
                //データベースに挿入
                $stmt = $bdd->prepare("INSERT INTO users (id, password, e_mail) VALUES (?, ?, ?)");
                $stmt->execute(array($id, $password,$mailaddress));  // パスワードのハッシュ化
             //   header('Location:login.php');  // ログイン画面へ遷移
                exit();  // 処理終了
            }
        } catch (PDOException $e) {
            echo 'データベースエラー';
        }
    }