<?php 
if (!file_exists(__DIR__ . "/config.php"))
{
header ("Location: /installer.php");
exit;
}
require_once(__DIR__ . "/config.php");
@session_start();
$image_width = 250;
$image_height = 50;
$characters_on_image = 6;
$font = ROOT_DIR. 'fonts/font1.ttf';
$random_dots = 0;
$random_lines = 0;
$captcha_text_color="0x142864";
$captcha_noice_color = "0x142864";

$my_array = array("dog","cat","sheep","sun","sky","red","ball","happy","ice","green","blue","music","movies","radio","green","turbo","mouse","computer","paper","water","fire","storm","chicken","boot","freedom","white","nice","player","small","eyes","path","kid","box","black","flower","ping","pong","smile","coffee","colors","rainbow","plus","king","tv","ring","chief","dark","envious","consist","passenger","try","peace","tangible","saw","petite","different","amuck","ship","deceive","massive","complete","towering","loutish","squirrel","count","employ","mark","accurate","dam","drag","productive","kindhearted","sin","moldy","feeble","hate","dog","post","red","file","start","mellow","spiritual","wrap","sun","volleyball","dry","shave","sneeze","grape","pretty","cart","type","talk","marble","clip","oil","measure","rifle","star","suggest","snow","permit","challenge","squealing","breath","hop","tire","shock","cherry","erect","spotted","tickle","corn","befitting","thankful","space","metal","wanting","young","afterthought","meaty","protest","plough","page","sock","force","silly","mouth","nine","standing","suggestion","robin","station","wilderness","smiling","kill","obtain","invincible","eight","fascinated","level","excellent","sparkling","smash");
$random_key1 = array_rand($my_array);
$random_key2 = array_rand($my_array);

/** Word Processing **/
$random_key1 = array_rand($my_array);
$random_key2 = array_rand($my_array);
$word1 =$my_array[$random_key1];
$strlen = strlen($word1);
$rand = rand(1,$strlen);
$rand2 = rand(1,$strlen);
$newword1 = str_replace($word1[$rand-1],strtoupper($word1[$rand-1]),$word1);
$newword1 = str_replace($newword1[$rand2-1],strtoupper($newword1[$rand2-1]),$newword1);
$word2 =$my_array[$random_key2];
$strlen = strlen($word2);
$rand = rand(1,$strlen);
$rand2 = rand(1,$strlen);
$newword2 = str_replace($word2[$rand-1],strtoupper($word2[$rand-1]),$word2);
$newword2 = str_replace($newword2[$rand2-1],strtoupper($newword2[$rand2-1]),$newword2);
/** Word Processing **/


$code= $newword1.' '.$newword2;
if (strlen($code)>15)
{$font_size = 12;}
else
if (strlen($code)>10)
{$font_size = 17;}
else
{$font_size = 20;}
$image = @imagecreate($image_width, $image_height);

$background_color = imagecolorallocate($image, 255, 255, 255);

$arr_text_color = hexrgb($captcha_text_color);
$text_color = imagecolorallocate($image, $arr_text_color['red'], 
		$arr_text_color['green'], $arr_text_color['blue']);

$arr_noice_color = hexrgb($captcha_noice_color);
$image_noise_color = imagecolorallocate($image, $arr_noice_color['red'], 
		$arr_noice_color['green'], $arr_noice_color['blue']);
		
for( $i=0; $i<$random_dots; $i++ ) {
imagefilledellipse($image, mt_rand(0,$image_width),
 mt_rand(0,$image_height), 2, 3, $image_noise_color);
}

for( $i=0; $i<$random_lines; $i++ ) {
imageline($image, mt_rand(0,$image_width), mt_rand(0,$image_height),
 mt_rand(0,$image_width), mt_rand(0,$image_height), $image_noise_color);
}
$textbox = imagettfbbox($font_size, 0, $font, $code); 
$x = ($image_width - $textbox[4])/2;
$y = ($image_height - $textbox[5])/2;
imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code);
header('Content-Type: image/jpeg');
imagejpeg($image);
imagedestroy($image);
$_SESSION['captchacode'] = $code;

function hexrgb ($hexstr)
{
$int = hexdec($hexstr);
return array("red" => 0xFF & ($int >> 0x10),
               "green" => 0xFF & ($int >> 0x8),
               "blue" => 0xFF & $int);
}
?>