
<html lang='ru'>
<head>
    <meta charset='UTF-8'>
    <title>Yandex карта</title>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

    <script type="text/javascript">
        ymaps.ready(init);
        var myMap,
            myPlacemark;

        function init(){
            myMap = new ymaps.Map("map", {
                center: [<?=$_GET['lat']?>, <?=$_GET['lon']?>],
                zoom: 7
            });

            myPlacemark = new ymaps.Placemark([<?=$_GET['lat']?>, <?=$_GET['lon']?>], {
                hintContent: '<?=urldecode($_GET['place'])?>',
                balloonContent: '<?=urldecode($_GET['place'])?>'
            });

            myMap.geoObjects.add(myPlacemark);
        }
    </script>

</head>
<body>
    <div id="map" style="width: 600px; height: 400px"></div>
</body>

<p><a href="redirect.php">Поиск улицы</a></p>
</html>