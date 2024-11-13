<title>Камалетдинов</title>
<div class="abc">
<form method="post" action="index.php">
<?php
	$serverName="localhost";
	$userName="SkyDead_17";
	$password="Maks16042005";
	$dbName="kamaletdinov";
	$connection = new mysqli($serverName, $userName, $password, $dbName);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8">
    <title>SQL Command Executor</title>
</head>
<body>
    <h1>Выберите группу команд</h1>
    
    <form method="post">
        <button type="submit" name="ddl">DDL Команды</button>
        <button type="submit" name="dml">DML Команды</button>
        <?php echo "<br>"; ?>
    </form>

    <?php if (isset($_POST['ddl']) || isset($_POST['dml'])): ?>
        <h2>Выберите команду</h2>
        <form method="post">
            <?php if (isset($_POST['ddl'])): ?>
                <input type="hidden" name="ddl" value="1">
                <select name="ddl_command">
                    <option value="create1">Создать таблицу (пользователи)</option>
                    <option value="create2">Создать таблицу (игровые данные пользователя)</option>
                    <option value="alterAdd">Изменить таблицу(Добавить столбец)</option>
                    <option value="alterDrop">Изменить таблицу(Удалить столбец)</option>
                    <option value="drop">Удалить таблицу</option>
                </select>
                <input method="post" type="" name="str" placeholder="Название таблицы">
            <?php elseif (isset($_POST['dml'])): ?>
                <input type="hidden" name="dml" value="1">

                <select name="dml_command">
                    <option value="insert1">Добавить записи в таблицу пользователи</option>
                    <option value="insert2">Добавить записи в таблицу с игровыми данными</option>
                    <option value="join">Выбрать записи с JOIN(необходимо 2 названия таблицы)</option>
                    <option value="select">Напечатать таблицу</option>
                    <option value="update">Обновить запись</option>
                    <option value="delete">Удалить запись(необходимо ID)</option>
                </select>
                <input method="post" type="" name="str" placeholder="Название таблицы">
                <input method="post" type="" name="str3" placeholder="Название таблицы 2">
                <input method="" type="" name="str2" placeholder="id пользователя">
            <?php endif; ?>
            <button type="submit" name="btn">Выполнить</button>

        </form>
    <?php endif; ?>
</body>
</html>
<?php
    function createTable1($connection){
        $field = "";
        if (isset($_POST["btn"])){
            $field = $_POST["str"];
            $sql = "CREATE TABLE IF NOT EXISTS {$field} (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                age INT NOT NULL
            )";
            // Выполнение запроса
            if ($connection->query($sql) === TRUE) {
                echo "Таблица {$field} успешно создана.";
            } else {
                echo "Ошибка создания таблицы: " . $connection->error;
            }
        }
    }
?>
<?php
    function createTable2($connection){
        $field = "";
        if (isset($_POST["btn"])){
            $field = $_POST["str"];
            $sql = "CREATE TABLE IF NOT EXISTS {$field} (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                game VARCHAR(255) NOT NULL
            )";
            // Выполнение запроса
            if ($connection->query($sql) === TRUE) {
                echo "Таблица {$field} успешно создана.";
            } else {
                echo "Ошибка создания таблицы: " . $connection->error;
            }
        }
    }
?>

<?php
    function insertRandomData1($connection) {
        $field = "";
        if (isset($_POST["btn"])){
            $field = $_POST["str"];
            // Выполнение запроса
            for($i = 1; $i < 22; ++$i){
                $random_name = 'User_'.$i;
                $random_age = rand(18,60);

                $insert_query = "INSERT INTO {$field} (name, age) VALUES ('{$random_name}', '{$random_age}')";
                $connection->query($insert_query);
            }  
            if ($connection->query("INSERT INTO {$field} (name, age) VALUES ('----------', 0)") === TRUE) {
                echo "Таблица {$field} успешно заполнена.";
            } else {
                echo "Ошибка заполнения таблицы {$field}: " . $connection->error;
            }
        }
    }
?>
<?php
    function insertRandomData2($connection) {
        $array_games=array("Valorant", "Dota 2", "CS2", "GTA5", "Minecraft", "Fortnite");
        $field = "";
        if (isset($_POST["btn"])){
            $field = $_POST["str"];
            // Выполнение запроса
            for($i = 1; $i < 22; ++$i){
                $random_game = $array_games[array_rand($array_games)];

                $insert_query = "INSERT INTO {$field} (game) VALUES ('{$random_game}')";
                $connection->query($insert_query);
            } 
            if ($connection->query("INSERT INTO {$field} (game) VALUES ('----------')") === TRUE) {
                echo "Таблица {$field} успешно заполнена.";
            } else {
                echo "Ошибка заполнения таблицы {$field}: " . $connection->error;
            }
        }
    }
?>
<?php
    function insertRandomCity($connection) {
        $array_cities=array("Пермь", "Екатеринбург", "Санкт-Петербург", "Москва", "Los Angeles", "Tokyo");
        $field = "";
        if (isset($_POST["btn"])){
            $field = $_POST["str"];
            // Выполнение запроса
            $sql = "SELECT COUNT(*) AS total FROM {$field}";
            for($i = 1; $i <= $sql; ++$i){
                $random_city = $array_cities[array_rand($array_cities)];
                $insert_query = "UPDATE {$field} SET city = '{$random_city}' WHERE id={$i}";
                $connection->query($insert_query);
            }
            if ($connection->query("UPDATE {$field} SET city = '----------' WHERE id={$i}") === TRUE) {
                echo "Таблица {$field} успешно обновлена.";
            } else {
                echo "Ошибка обновления таблицы {$field}: " . $connection->error;
            }
        }
    }
?>
<?php
    function deleteTable($connection){
        $field = "";
        if (isset($_POST["btn"])){
            $field = $_POST["str"];
            $insert_query = "DROP TABLE {$field}";
            // Выполнение запроса
            if ($connection->query($insert_query) === TRUE) {
                echo "Таблица {$field} успешно удалена.";
            } else {
                echo "Ошибка удаления таблицы {$field}: " . $connection->error;
            }
        }
    }
?>
<?php
    function alterAddTable($connection){
        $field = "";
        if (isset($_POST["btn"])){
            $field = $_POST["str"];
            $insert_query = "ALTER TABLE {$field} ADD COLUMN city VARCHAR(100)";
            // Выполнение запроса
            if ($connection->query($insert_query) === TRUE) {
                echo "Таблица {$field} успешно изменена.";
            } else {
                echo "Ошибка изменения таблицы {$field}: " . $connection->error;
            }
        }
    }
?>
<?php
    function alterDropTable($connection){
        $field = "";
        if (isset($_POST["btn"])){
            $field = $_POST["str"];
            $insert_query = "ALTER TABLE {$field} DROP COLUMN city";
            // Выполнение запроса
            if ($connection->query($insert_query) === TRUE) {
                echo "Таблица {$field} успешно изменена.";
            } else {
                echo "Ошибка изменения таблицы {$field}: " . $connection->error;
            }
        }
    }
?>
<?php
    function selectTable($connection) {
        $field = "";
        if (isset($_POST["btn"])){
            $field = $_POST["str"];
            // Выполнение запроса
            $insert_query = "SELECT * FROM {$field}";
            $result = $connection->query($insert_query);
            while ($field_info = $result->fetch_field()) {
                echo " | " . htmlspecialchars($field_info->name);
            }
            echo "<br>";
            while($row = $result->fetch_assoc()){
                echo "<tr>";
                foreach($row as $cell){
                    echo " | " . htmlspecialchars($cell);
                }
                echo "<br>";
            }
        }
    }
?>
<?php
    function deleteEntry($connection){
        $field = "";
        $id = "";
        if (isset($_POST["btn"])){
            $field = $_POST["str"];
            $id = $_POST["str2"];
            $insert_query = "DELETE FROM {$field} WHERE id = {$id}";
            // Выполнение запроса
            if ($connection->query($insert_query) === TRUE) {
                echo "Запись {$field} успешно удалена.";
            } else {
                echo "Ошибка удаления записи {$field}: " . $connection->error;
            }
        }
    }
?>
<?php
    function selectJoin($connection){
        $field = "";
        $field2 = "";
        if (isset($_POST["btn"])){
            $field = $_POST["str"];
            $field2 = $_POST["str3"];
            $insert_query = "SELECT {$field}.id, {$field}.name, {$field2}.game FROM {$field} INNER JOIN {$field2} ON {$field}.id = {$field2}.id";
            // Выполнение запроса
            $result = $connection->query($insert_query);
            while ($field_info = $result->fetch_field()) {
                echo " | " . htmlspecialchars($field_info->name);
            }
            echo "<br>";
            while($row = $result->fetch_assoc()){
                echo "<tr>";
                foreach($row as $cell){
                    echo " | " . htmlspecialchars($cell);
                }
                echo "<br>";
            }
        }
    }
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['ddl_command'])){
            switch($_POST['ddl_command']){
                case 'create1':
                    createTable1($connection);
                    break;
                case 'create2':
                    createTable2($connection);
                    break;
                case 'alterAdd':
                    alterAddTable($connection);
                    break;
                case 'alterDrop':
                    alterDropTable($connection);
                    break;
                case 'drop':
                    deleteTable($connection);
                    break;
            }
        }
    }
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['dml_command'])){
            switch($_POST['dml_command']){
                case 'insert1':
                    insertRandomData1($connection);
                    break;
                case 'insert2':
                    insertRandomData2($connection);
                    break;
                case 'join':
                    selectJoin($connection);
                    break;
                case 'select':
                    selectTable($connection);
                    break;
                case 'update':
                    insertRandomCity($connection);
                    break;
                case 'delete':
                    deleteEntry($connection);
                    break;
            }
        }
    }
?>




