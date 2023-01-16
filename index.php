<?php

$weather = "";

$error = "";

 if ($_GET['city']) {

  $city = str_replace(' ', '', $_GET['city']);

  $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
      if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {

    $error = "Вы неправильно написали город";
  
      } else {

      

  $forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");

  $pageArray = explode('</div><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);

    if(sizeof($pageArray) > 1) {

  $secondPageArray = explode('</span></p></td>', $pageArray[1]);

      if(sizeof($secondPageArray) > 1) {

       $weather = $secondPageArray[0]; 

      } else {
        $error = "Вы неправильно написали город";
      }
  } else {
    $error = "Вы неправильно написали город";
  }
 }
}
?>

<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Погода(Практика PHP)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
  <style>
    html{ 
    background: url(https://images.unsplash.com/photo-1673725437337-d8582e739c24?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }
  body{
    background: none;
  }
  .container{
    text-align: center;
    margin-top: 100px;
    width: 450px;
  }

  input {
    margin: 20px 20px;
  }

  #weather{
    margin-top: 15px;
  }

  </style>
  
</head>
  
  <body>

    <div class="container">
      <h1>Какая сейчас погода?</h1>


      <p>Введите город(На английском)</p>
    <form>
    <div class="mb-3">
      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Kemerovo/London/Tokyo" name="city" value="<?php echo $_GET['city'];?>">
    </div>
    <button type="submit" class="btn btn-primary">Отправить</button>
  </form>

    <div id="weather"><?php
    
  if ($weather) {

      echo '<div class="alert alert-success" role="alert">
      '.$weather.'
      
      </div>';} else {  echo '<div class="alert alert-danger" role="alert">
        '.$error.'
        
        </div>'; }

    ?></div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>