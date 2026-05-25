<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Docker Compose Training</title>
</head>
<body>

<h1>Docker Compose Training</h1>

<h2>Данные из MySQL</h2>

<?php
$mysqlHost = 'db';
$mysqlUser = 'user';
$mysqlPassword = 'test';
$mysqlDatabase = 'myDb';

$mysqlConnection = new mysqli($mysqlHost, $mysqlUser, $mysqlPassword, $mysqlDatabase);

if ($mysqlConnection->connect_error) {
    echo '<p>Ошибка подключения к MySQL: ' . $mysqlConnection->connect_error . '</p>';
} else {
    echo '<p>Подключение к MySQL успешно</p>';

    $mysqlResult = $mysqlConnection->query('SELECT id, name FROM Person');

    if ($mysqlResult) {
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Name</th></tr>';

        while ($row = $mysqlResult->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '</tr>';
        }

        echo '</table>';

        $mysqlResult->close();
    } else {
        echo '<p>Ошибка запроса MySQL: ' . $mysqlConnection->error . '</p>';
    }

    $mysqlConnection->close();
}
?>

<h2>Данные из PostgreSQL</h2>

<?php
$postgresHost = 'postgresql';
$postgresPort = '5432';
$postgresDatabase = 'myPgDb';
$postgresUser = 'user';
$postgresPassword = 'test';

$postgresConnectionString = "host=$postgresHost port=$postgresPort dbname=$postgresDatabase user=$postgresUser password=$postgresPassword";

$postgresConnection = pg_connect($postgresConnectionString);

if (!$postgresConnection) {
    echo '<p>Ошибка подключения к PostgreSQL</p>';
} else {
    echo '<p>Подключение к PostgreSQL успешно</p>';

    $postgresResult = pg_query($postgresConnection, 'SELECT id, name FROM person_pg ORDER BY id');

    if ($postgresResult) {
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Name</th></tr>';

        while ($row = pg_fetch_assoc($postgresResult)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>Ошибка запроса PostgreSQL: ' . pg_last_error($postgresConnection) . '</p>';
    }

    pg_close($postgresConnection);
}
?>

</body>
</html>
