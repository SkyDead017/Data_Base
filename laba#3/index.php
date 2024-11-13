<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8">
    <title>Камалетдинов</title>
</head>
<div class="abc">
<form method="post" action="index.php">
<h1> Выберите запрос: </h1>
<input type="submit" name="name1" value="1 Запрос"/>
<input type="submit" name="name2" value="2 Запрос"/>
<input type="submit" name="name3" value="3 Запрос"/>
<?php
	if(isset($_POST["name1"])){ //проверка нажатия кнопки
		echo "<br>";
		$serverName="localhost";
		$userName="SkyDead_17";
		$password="Maks16042005";
		$databaseName="kamaletdinov";
		$connect = new mysqli($serverName, $userName, $password, $databaseName); //установка соединения с бд
		$query = $connect->query("SELECT id, ФИО, Номер_телефона, Зарплата FROM table_kamaletdinov;"); 
		echo "<h2>Результаты запроса 1: </h2>";
		while($result = $query->fetch_assoc()){ //получение данных из базы данных
			echo "ID: ".$result["id"]."<br>";
			echo "ФИО: ".$result["ФИО"]."<br>";
			echo "Номер телефона: ".$result["Номер_телефона"]."<br>";
			echo "Зарплата: ".$result["Зарплата"]."<br>";
			echo"|--------------------------------------------------------|<br>";
		}
	}
	if(isset($_POST["name2"])){
		echo "<br>";
		$serverName="localhost";
		$userName="SkyDead_17";
		$password="Maks16042005";
		$databaseName="kamaletdinov";
		$connect = new mysqli($serverName, $userName, $password, $databaseName);
		$query = $connect->query("SELECT id, ФИО, Адресс FROM table_kamaletdinov ORDER BY Адресс ASC;");
		echo "<h2>Результаты запроса 2: </h2>";
		while($result = $query->fetch_assoc()){
			echo "ID: ".$result["id"]."<br>";
			echo "ФИО: ".$result["ФИО"]."<br>";
			echo "Адресс: ".$result["Адресс"]."<br>";
			echo"|---------------------------------------------------------|<br>";
		}
	}
	if(isset($_POST["name3"])){
		echo "<br>";
		$serverName="localhost";
		$userName="SkyDead_17";
		$password="Maks16042005";
		$databaseName="kamaletdinov";
		$connect = new mysqli($serverName, $userName, $password, $databaseName);
		$query = $connect->query("SELECT id, ФИО, Продолжительность_трудовой_деятельности FROM table_kamaletdinov WHERE Продолжительность_трудовой_деятельности>4;");
		echo "<h2>Результаты запроса 3: </h2>";
		while($result = $query->fetch_assoc()){
			echo "ID: ".$result["id"]."<br>";
			echo "ФИО: ".$result["ФИО"]."<br>";
			echo "Продолжительность трудовой деятельности: ".$result["Продолжительность_трудовой_деятельности"]."<br>";
			echo"|--------------------------------------------------------------|<br>";
		}
	}
?>
</form>
</div>