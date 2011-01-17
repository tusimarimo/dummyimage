<?php

// 画像サイズ取得
if( isset( $_GET["size"] ) ) {
	$size = $_GET["size"];
} else{
	$size = 80; // 初期値適当に
}

// パラメータから縦横取得
if( preg_match('/^\d+$/', $size, $matches ) == 1 ){
	$width = $height = $matches[0];

}else if( preg_match('/(\d+)x(\d+)/', $size, $matches) == 1 ){
	$width = $matches[1];
	$height = $matches[2];
}

// 画像作成
$img = ImageCreate($width, $height);

// 画像背景色取得
if( isset( $_GET["bg"] ) ) {
	switch( $_GET["bg"] ) {
		case "gray":
			$bg = ImageColorAllocate( $img, 0xCC, 0xCC, 0xCC );
			$cl = ImageColorAllocate( $img, 0x00, 0x00, 0x00 );
			break;
		case "blue":
			$bg = ImageColorAllocate( $img, 0x00, 0x66, 0xFF );
			$cl = ImageColorAllocate( $img, 0xFF, 0xCC, 0xFF );
			break;
		case "pink":
			$bg = ImageColorAllocate( $img, 0xFF, 0x66, 0x99 );
			$cl = ImageColorAllocate( $img, 0x99, 0x99, 0x99 );
			break;
		case "green":
			$bg = ImageColorAllocate( $img, 0x33, 0xCC, 0x33 );
			$cl = ImageColorAllocate( $img, 0x66, 0x66, 0x66 );
			break;
	}
} else{
	$bg = ImageColorAllocate( $img, 0xCC, 0xCC, 0xCC );
	$cl = ImageColorAllocate( $img, 0x00, 0x00, 0x00 );
}

ImageFilledRectangle( $img, 0,0, $width, $height, $bg );
// 画像に文字挿入
imagestring( $img, 5, 5, 5,  $width . 'x' . $height, $cl );
// imagettftext( $img, 20, 0, $x, $y, ImageColorAllocate($img, 0x00, 0x00, 0x00), "font/AB.ttf", $width.'x'.$height );

header("Content-Type: image/png");
ImagePNG($img);

?>
