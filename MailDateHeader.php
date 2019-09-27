<?php

/**
 * RFC822 で定義されている date メールヘッダが入る事を想定しています。
 * 参考情報 : http://itdoc.hitachi.co.jp/manuals/3020/30203D1390/0173.htm#ID00324
 * @see 関連関数 なし
 * */
$dateH = "null";

define( "TEST_CASE_1", "6 Mar 2019 06 00 01 +0900 (JST)" );
define( "TEST_CASE_2", "Sun, 3 Mar 2019 00 39 28 +0900 (JST)" );
define( "TEST_CASE_3", "Wed, 06 Mar 2019 06 01 28 +0900" );
define( "TEST_CASE_4", "6 Mar 2019 06 00 01 +0900 (JST)" );
define( "TEST_CASE_5", "Sat, 23 Feb 2019 22:40:01 +0900 (JST)" );
define( "TEST_CASE_6", "Thu, 26 Sep 2019 22:16:36 -0000" );
define( "TEST_CASE_7", "25 Feb 2001 22:20 +0900" );
define( "TEST_CASE_8", "" );

try {
	$dateH = TEST_CASE_3;
	if( $dateH == null ) throw new \Exception( "メールヘッダに、Dateヘッダがありませんでした。\n該当のメールを現在日時で受信されたものとして処理しました。" );
	$myDt = new \DateTime( $dateH );
	$myDt->setTimezone( new \DateTimeZone( "Asia/Tokyo" ) );
	echo $myDt->format('Y-m-d H:i:s') . PHP_EOL;

} catch( \Exception $e ) {
	if( preg_match( "/Failed to parse time string/", $e->getMessage( ) ) ) var_dump( "RFC822で定義されているフォーマットと違う、Dateヘッダを検知しました。(参考情報 : http://itdoc.hitachi.co.jp/manuals/3020/30203D1390/0173.htm#ID00324)\n該当メールヘッダを現在の日次に置き換えました。\nエラー内容 : " . $e->getMessage( ) . "\nトレース内容 : " . $e->getTraceAsString( ) );
	else var_dump( $e->getMessage( ) );

}

?>
