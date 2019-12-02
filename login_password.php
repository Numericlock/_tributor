<?php
    require 'bdd.php';
    session_start();
    if (!empty($_POST['logout'])){
        // セッションの変数のクリア
    $_SESSION = array();

    // セッションクリア
    session_destroy();
    }	
    
    $challenge=random(64);
                           
    function random($length){
        return substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }
    //データベースに挿入
    $stmt = $bdd->prepare('SELECT * FROM users_sessions WHERE id = ?');
    $stmt->execute(array(session_id()));

    $cntent =$stmt->rowCount();

    if($cntent != '0'){
        try {
            $stmt = $bdd->prepare("UPDATE users_sessions SET challenge = ? WHERE id = ? ");
            $stmt->execute(array($challenge, session_id()));  
        }catch (PDOException $e) {

        }
    }else{
        try {
            //データベースに挿入
            $stmt = $bdd->prepare("INSERT INTO users_sessions (id, challenge) VALUES (?, ?)");
            $stmt->execute(array(session_id(), $challenge));  

        }catch (PDOException $e) {

        }
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<script>
		window.location.href = 'login_id.php'; 
	</script>
	<meta charset="utf-8">
	<title>ログイン</title>
	<script src="public/js/jquery-2.1.3.js"></script>
	<script src="public/js/jquery.pjax.js"></script>
	<script src="public/js/barba.js"></script>
	<script src="public/js/sha256.js"></script>
    <link rel="icon" href="public/favicon.ico">
	<link rel="stylesheet" href="public/css/fonts.css">
	<link rel="stylesheet" href="public/css/opening-common.css">
	<link rel="stylesheet" href="public/css/login.css">
	<link rel="stylesheet" href="public/css/wave.css">
</head>
<body>
    <div id="barba-wrapper">
        <div class='wave -one'></div>
        <div class='wave -two'></div>
        <div class='wave -three'></div>
        <div class="barba-container">
                <div class="title-wrapper">
                    <span class="app-title">-tributor</span>
                    <span class="form-title">ログイン</span>
                </div>		
                <div>
                    <div class="password_box box">
                        <div class="password_inner inner">
                            <input id="text2" class="text" type="password">
                            <div class="password_string string">パスワード</div>
                        </div>
                        <i class="fas fa-eye-slash"></i>
                    </div>
                </div>
                <div class="control-button login-button">
                    <button type="button" id="login">ログイン</button>
                    <input type="hidden" class="password-text" id="<?php echo $challenge ?>">
                </div>
            </div>
    </div>
</body>
</html>