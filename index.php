<?php
include 'vendor/autoload.php';
$api = new \Yandex\Geo\Api();

// Можно искать по точке
//$api->setPoint(30.5166187, 50.4452705);

// Или можно икать по адресу
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST) && isset($_POST['address']) && !empty($_POST['address'])) {
    $api->setQuery($_POST['address']);

// Настройка фильтров
    $api
        ->setLimit(200) // кол-во результатов
        ->setLang(\Yandex\Geo\Api::LANG_RU)// локаль ответа
        ->load();

    $response = $api->getResponse();
//    $response->getFoundCount(); // кол-во найденных адресов
//    $response->getQuery(); // исходный запрос
//    $response->getLatitude(); // широта для исходного запроса
//    $response->getLongitude(); // долгота для исходного запроса

// Список найденных точек
    $collection = $response->getList();
}

?>
<html lang='ru'>
<head>
    <meta charset='UTF-8'>
    <title>Менеджер зависимостей Composer</title>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <style>
        td {padding: 5px 20px 5px 20px;border: 1px solid black;}
        thead td {text-align: center;background-color: #dbdbdb;font-weight: 700;}
        table {border-collapse: collapse;border-spacing: 0;}
    </style>
</head>
<body>
    <form method='POST'>
        <input type="text" name="address" placeholder='Введите адрес'>
        <input type='submit' value="Найти" name='find'>
    </form>
    <?php if (!empty($collection)) :?>
    <table>
        <thead>
        <tr>
            <td>Адрес</td>
            <td>Широта</td>
            <td>Долгота</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($collection as $item) :?>
            <tr>
                <td><a href="yandexmap.php?lat=<?=$item->getLatitude()?>&lon=<?=$item->getLongitude()?>&place=<?=urldecode($item->getAddress())?>"><?=$item->getAddress()?></a></td>
                <td><?=$item->getLatitude()?></td>
                <td><?=$item->getLongitude()?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php endif; ?>
</body>
</html>