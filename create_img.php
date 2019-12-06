<?php
//canvasデータがPOSTで送信されてきた場合
$canvas = $_POST["base64"];
 
//ヘッダに「data:image/png;base64,」が付いているので、それは外す
$canvas = preg_replace("/data:[^,]+,/i","",$canvas);
 
//残りのデータはbase64エンコードされているので、デコードする
$canvas = base64_decode($canvas);
 
//まだ文字列の状態なので、画像リソース化
$image = imagecreatefromstring($canvas);
 
//画像として保存（ディレクトリは任意）
$img_path = unique_filename('public/img/proimg');
imagesavealpha($image, TRUE); // 透明色の有効
imagepng($image ,$img_path);


function unique_filename($org_path, $num=0){
     
    if( $num > 0){
        $info = pathinfo($org_path);
        $path = $info['dirname'] . "/" . $info['filename'] . "_" . $num;
        if(isset($info['extension'])) $path .= "." . $info['extension'];
    } else {
        $path = $org_path;
    }
     
    if(file_exists($path)){
        $num++;
        return unique_filename($org_path, $num);
    } else {
    	$path.=".png";
        return $path ;
    }
}
?>

