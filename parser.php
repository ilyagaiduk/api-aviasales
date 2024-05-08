<?php

if(isset($_POST['allVilet'])) {
    $cityVilet = $_POST['vilet'];
}
else {
    $cityVilet = $_POST['cityVilet'];
}
if(isset($_POST['allPrilet'])) {
    $cityPrilet = $_POST['prilet'];
}
else {
    $cityPrilet = $_POST['cityPrilet'];
}
$dateVilet = $_POST['dateVilet'];
$datePrilet = $_POST['datePrilet'];
$countResults = $_POST['countResults'];
$url = 'https://api.travelpayouts.com/aviasales/v3/prices_for_dates?origin='.$cityVilet.'&destination='.$cityPrilet.'&departure_at='.$dateVilet.'&return_at='.$datePrilet.'&sorting=price&currency=rub&limit='.$countResults.'&token=9415389f2f848d6497887e8303136658';

$headers = []; // создаем заголовки

$curl = curl_init(); // создаем экземпляр curl

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_VERBOSE, 1); 
curl_setopt($curl, CURLOPT_POST, false); // 
curl_setopt($curl, CURLOPT_URL, $url);

$result = curl_exec($curl);
$result = json_decode($result);
foreach($result as $value) {   
     
    foreach($value as $newValue) {
        
        echo "<table class='table'>";
        echo "<tr>";
        echo "<td>Результат на Aviasales</td>";
        echo "<td><a target='_blank' href='https://www.aviasales.ru".$newValue->link."'>Ссылка</a></td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Пункт отправления</td>";
        echo "<td>".$newValue->origin."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Пункт назначения</td>";
        echo "<td>".$newValue->destination."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Аэропорт вылета</td>";
        echo "<td>".$newValue->origin_airport."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Аэропорт прилета</td>";
        echo "<td>".$newValue->destination_airport."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Номер рейса</td>";
        echo "<td>".$newValue->flight_number."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>IATA-код авиакомпании</td>";
        echo "<td>".$newValue->airline."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Цена</td>";
        echo "<td>".$newValue->price." ₽</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Время отправления</td>";
        echo "<td>".$newValue->departure_at."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Время отправления обратно</td>";
        echo "<td>".$newValue->return_at."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Длительность полета туда обратно в мин.</td>";
        echo "<td>".$newValue->duration." мин.</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Количество пересадок на пути 'Туда'</td>";
        echo "<td>".$newValue->transfers." пер.</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Количество пересадок на пути 'Обратно'</td>";
        echo "<td>".$newValue->return_transfers." пер.</td>";
        echo "</tr>";
        echo "</table><br><br>";
        
    }
    
}


