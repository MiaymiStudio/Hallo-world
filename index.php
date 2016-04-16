<?php 
header("Content-Type: text/html; charset=utf-8");

define('Encoding', 'CP1251');

require_once ("../vendor/autoload.php");

$json_obj = new Services_JSON();
	
$str = file_read("../../js/hero.json");

$arr = array(
	'Name' => 'Сергей',
	'Description' => '', 
	'Target' => '', 
	'Function' => '',
	'Item' => array(
		0 => array(
			'table' => '',
			'row' => '', 
			'prop' => '',
			'value' => ''),
		1 => array(
			'table' => '',
			'row' => '', 
			'prop' => '',
			'value' => ''),
		2 => array(
			'table' => '',
			'row' => '', 
			'prop' => '',
			'value' => ''),
		3 => array(
			'table' => '',
			'row' => '', 
			'prop' => '',
			'value' => '')));

$js_str = $json_obj->encode($arr);

print "$js_str\n";

// begin file_read
function file_read($fname){
	// Открываем на чтение файл в текстовом режиме
	$f = fopen($fname, "rt") or die ("Обшибка при открытии файла $fname");

	// Ставим указатель в начало файла и считываем его
	fseek($f,0);
	$str = trim(fread($f,filesize($fname)));

	// Закрываем файл
	fclose($f);

	return $str;
}
// end file_read

// begin json_reed 
function json_read($fname, $assoc=false){
	// Читаем файл json
	$str_json = file_read($fname);

	// Приводим json сущности к php данным, cамо преобразование. 
	// Возвращаемый тип данных stdClass Object
	// Но при желании можно преобразовать в ассоциативный массив
	$json = json_decode($str_json, $assoc);

	return $json;
}
// end json_read

$JS_OBJ = json_read("../../js/hero.json");
$JS_MAS = json_read("../../js/hero.json",true);

	echo "<pre>\n";
		print_r ($JS_OBJ);
	echo "</pre>\n";

	$e_mas = each($JS_MAS);

	echo "<pre>\n";
	var_dump($e_mas[1][0]);
	echo "</pre>\n";

	obj_for($JS_MAS);

	// foreach ($JS_MAS as $k => $v) echo "Each $k = $v<br>\n";

// begin obj_for
 function obj_for($arr){
 	$i = each($arr);
 	echo $i["key"]." = [<br>\n";
 	for (reset($i['value'][0]); list ($k,$v) = each($i['value'][0]); ){
 		if (!is_array($v))
 	 		echo "\t$k = $v<br>\n";
 	 	else {
 	 		echo "\t$k = [<br>\n";
 	 		if_arr($v,3);
 	 		echo "\t]<br>\n";
 	 	}
 	}
 	echo "]<br>\n";
 }
 // end obj_for 
 
 // begin if_arr
 function if_arr($arr, $n=0){
 	$indent = str_repeat("\t", $n);
 	for (reset($arr); list($k,$v) = each($arr); ){
 		echo $indent;
 		if (is_string($k))
	 		echo "$k = ";
 		if (is_array($v)){
 			echo "[<br>\n";
 			$n++;
 			if_arr($v,$n);
 			$n--;
 			echo $indent;
 			echo "]<br>\n";
 		}
 		else 
 	 		echo "$v<br>\n";
 	 }
 }
 // end if_arr

?>