<?php 
$countryCode = $_GET['code'];
$f_json = __dir__.'/cities.json';
$json = json_decode(file_get_contents("$f_json"));
if($_GET['id'] == 'vilet') {      
   echo "<select name='cityVilet' class='form-select'>";
}
if($_GET['id'] == 'prilet') {
   echo "<select name='cityPrilet' class='form-select'>";
}
$data = [];
foreach($json as $value) {
   if($value->country_code == $countryCode) {      
      echo $data[$value->code] = $value->name_translations->ru;     
  }
}
asort($data);
foreach($data as $key => $value) {      
        echo "<option value=".$key.">".$value."</option>";   
    
 }
 echo "</select>";
