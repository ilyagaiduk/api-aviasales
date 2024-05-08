<!doctype html>
<html lang="ru">

<head>
    <!-- Обязательные метатеги -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous">
        </script>

    <title>Авиаперелеты Aviasales</title>
    
</head>

<body>
    <?php
    $f_json = __DIR__ . '/countries.json';
    $json = json_decode(file_get_contents("$f_json"));

    ?>

    <div class="container">
        <img src="/img/logo-avia.jpg" width="7%">
        <h1>Авиаперелеты Aviasales</h1>
        <span>Все билеты сортируются по цене</span>
        <div class="row mb-3">
            <div class="col-sm-5">
                <form method="post">

                    <select class="form-select country" name="vilet" id="vilet">
                        <option disabled>Выберите страну вылета</option>
                        <?php
                        $dataSort = [];
                        foreach ($json as $value) {
                            $dataSort[$value->code] = $value->name_translations->ru;
                        }
                        asort($dataSort);
                        foreach ($dataSort as $key => $value) {
                            echo "<option value='$key'>" . $value . "(" . $key . ")</option>";
                        }
                        ?>
                    </select>
                    <span>Любой город</span>
                    <input type="radio" name="allVilet" onMouseDown="this.isChecked=this.checked;"
                        onClick="this.checked=!this.isChecked;">
                    <br>
                    <div id="cityVilet"></div>

                    <br>
                    <select class="form-select country" name="prilet" id="prilet">
                        <option disabled>Выберите страну прилета</option>
                        <?php
                        foreach ($dataSort as $key => $value) {
                            echo "<option value='$key'>" . $value . "(" . $key . ")</option>";
                        }
                        ?>
                    </select>
                    <span>Любой город</span>
                    <input type="radio" name="allPrilet" onMouseDown="this.isChecked=this.checked;"
                        onClick="this.checked=!this.isChecked;">
                    <br>
                    <div id="cityPrilet"></div>
                    <br>
                    <span>Дата вылета</span>
                    <input type="date" name="dateVilet">
                    <br>
                    <br>
                    <span>Дата обратного прилета</span>
                    <input type="date" name="datePrilet">
                    <br>
                    <br>
                    <span>Количество результатов</span>
                    <input type="number" name="countResults" value="30">
                    <br>                    
                    <br>
                    <button class="btn btn-dark" name="submit" type="submit">Найти</button>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    include_once __DIR__ . '/parser.php';
                }
                ?>
                <script async src="https://tp.media/content?currency=rub&trs=28107&shmarker=162786&searchUrl=www.aviasales.ru%2Fsearch&locale=ru&powered_by=true&one_way=false&only_direct=false&period=year&range=7%2C14&primary=%230C73FE&color_background=%23ffffff&dark=%23000000&light=%23FFFFFF&achieve=%2345AD35&promo_id=4041&campaign_id=100" charset="utf-8"></script>
            </div>
            <div class="col-sm-4 ">
            </div>
        </div>
    </div>
    <script>
        $('.country').change(function () {
            let countryCode = this.value;
            let id = $(this).attr('id');
            $.ajax({
                url: '/cities.php',         /* Куда пойдет запрос */
                method: 'GET',             /* Метод передачи (post или get) */
                dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
                data: { code: countryCode, id: id },     /* Параметры передаваемые в запросе. */
                success: function (data) {
                    if (id == 'vilet') {
                        $('cityVilet').remove();
                        $('#cityVilet').html(data).after($("#vilet"))
                    }
                    else if (id == 'prilet') {
                        $('cityPrilet').remove();
                        $('#cityPrilet').html(data).after($("#prilet"));

                    }
                }
            });
        });
    </script>
</body>

</html>