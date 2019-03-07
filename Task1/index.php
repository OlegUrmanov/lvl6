<!DOCTYPE html>
<html>
	<head>

		<title>VK API</title>

<meta charset="utf-8">
<link href="style.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<?php
$access_token = "13329fe413329fe413329fe45b135b988e1133213329fe44f48341806b7271860f0bb7a"; // ключ приложения
$count_rand = rand(1,15); // функция рандом, выдает от 1 до 15 постов
$url = file_get_contents("https://api.vk.com/method/wall.get?owner_id=-26750264&count=$count_rand&filter=owner&version=5.92&access_token=$access_token"); // функция по которой подключаемся к нужной странице и используем нужный метод
$data = json_decode($url, true); // записываем полученные данные в json
if($data['error']['error_code']){ echo "Error <b>".$data['error']['error_code']."</b>";} // проверка на подключение к странице, если есть проблемы, то выдаем код ошибки метода
else{
  //echo '<pre>'; /* структурируем
  //print_r($data);    выводим значения */
  for($i=1;$i<$data['response'][$i];$i++){  // проходимся циклом по всем записям

/*-----------Проверяем на содерание следующих строк: Страна, Жанр, Рейтинг----------*/

		if (strpos($data['response'][$i]['text'], 'Страна: ') &&
				strpos($data['response'][$i]['text'], 'Жанр: ') &&
				strpos($data['response'][$i]['text'], 'Рейтинги: ')){
/*-----------------------------------------------------------------------------------*/
    echo"
    <div class='wr'>
    <div class='num'>".$i/*номер поста, выводим в верхнем левом углу*/."</div>
    <p>".$data['response'][$i]['text']/*выводим текст конкретного поста*/."</p>
		<p><i class='fa fa-heart'></i> ".$data['response'][$i]['likes']['count']/*выводим кол-во лайков конкретного поста*/."<a href='https://vk.com/xfilm?w=wall-26750264_".$data['response'][$i]['id']./*вставляем в ссылку id конкретного поста для перехода к записи*/"'> Смотреть на стене</a></p>
    <p>";
        if(empty($data['response'][$i]['attachment']['photo'] //проверка на содержание картинки поста и ее вывод
        ['src_big'])){}
        else{
          echo "<img src='".$data['response'][$i]['attachment']['photo']
          ['src_big']."'>";
        }
        echo "</p>
    </div>";
	}
  }
}
?>
</html>
