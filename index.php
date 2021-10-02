<html>
    <head>
        <meta charset="UTF-8">
        <title></title>   
        <style>
            h1{
                margin-left: 60px;
                text-decoration: blink;
                text-align: center;
                text-shadow:black;
            }
            body{
                background: url(loginimg.jpg);
                background-size: cover;
                font-style: bold; 
                font-size: medium;
                font-family:  sans-serif;
                margin-bottom: 50px;               
            }
            form
            {
                font-style: bold;
                font-size: 30px;
                margin-left: 120px;
            }
            input[type="text"]{
                margin-left: 80px;
                border-radius: 25px;
                width:20%;
                height: 40px;
                outline-style:bold; 
                font-size: 18px;
                background-color:antiquewhite; 
                font-family: sans-serif;
                font-style: bold;
            }
            input[type="text"]:hover{cursor:pointer;
            color: cornflowerblue;}
            input[type="submit"]
            {
            border:none;
            outline: none;
            height:40px;
            width:180px;
            background: darkgray;
            background: #7FFD4;
            color: #ff;
            font-size: 18px;
            border-radius: 20px;
            margin-left: 180px;
            }
            input[type="submit"]:hover
            {
            cursor:pointer;
            background:#e76d6b;
            color: bisque;
        }
        .frame{
            margin-top:-270px; 
            margin-left: 2100px;
            zoom: 0.50;
            width: 800px;
            height: 450px;
        }
        .tcss{
            text-align: center;      
            margin-left:auto; 
            margin-right:auto;
            width: 700px;
            font-style: bold;
            font-size: 18px;
            color: black;
            cellborder-outline: 20px;
            border-radius:30px;
            border-color: gray;
            border-width: 20px; 
            border-image-outset: 1.5;
            background-blend-mode: transparent; 
        }
        .hcss
        {
            font-size: 29px;
            color:darkcyan;
            border-radius: 50px;
            border-color: grey;
            margin-left: 530px;
        }
        </style>    
    </head>
    <body>
        <h1> CURRENT WEATHER INFORMATION </h1><br>
        <hr style="height:2px;border-width:5px;color:gray;background-color:gray"> <br> 
        <form action="index.php"  method = "post">
            Enter the Location (TamilNadu districts):

            <input type="text"  name = "city" id = "c"/><br><br> 
            <input type = "submit" value = "GET WEATHER" name = "button" id = "btn"/><br>   </form>
        
            <img class = "frame" src="weatherGif.gif" width = "100" height = "0">
           
     <br><br>      
        <?php
        if(isset($_POST['button'])){
        $city= $_POST['city'];
        $url='https://api.openweathermap.org/data/2.5/weather?q='.urlencode($city).'&appid=299d46115a75cc07a823594680426680';
        $lines_array=file($url);
        $lines_string=implode('',$lines_array);
        file_put_contents("weatherReport.json", $lines_string);
        $data = json_decode($lines_string, true);
        echo  "<p class = hcss>"." \nCurrent ".$city . "  Weather \n\n\n</p>";
        echo "<br><br>";
        $lat = $data["coord"]["lat"];
        $lon = $data["coord"]["lon"];
        $desc = $data["weather"][0]["description"];
        $temp =  $data["main"]["temp"];
        $pres = $data["main"]["pressure"];
        $hum = $data["main"]["humidity"];
        $ws = $data["wind"]["speed"];
        $wd =  $data["wind"]["deg"];
        $cd =  $data["clouds"]["all"];
        $coname = $data["sys"]["country"];
        $rise = $data["sys"]["sunrise"];
        $set = $data["sys"]["sunset"];
        $cityname = $data["name"];
        echo "<table  class = 'tcss' cellspacing = '20' cellborder= '0' border = '1' cellpadding = '6'>     
        <tr>  <td > Latitude  :</td> <td>$lat </td> </tr> 
        <tr> <td> Longitude :  </td> <td>$lon</font></td> </tr>
        <tr> <td> Weather Condition :    </td> <td> $desc </td> </tr>
        <tr> <td> Temperature   :      </td> <td> $temp  Kelvin  </td> </tr>
        <tr> <td> Pressure     :      </td> <td> $pres  Atmospheric pressure </td> </tr>
        <tr> <td> Humidity      :     </td> <td> $hum  % </td> </tr>
        <tr> <td> Wind Speed  :      </td> <td> $ws meter/sec </td> </tr>    
        <tr> <td> Wind direction   :   </td> <td> $wd in degrees </td> </tr> 
        <tr> <td> Cloudiness   :   </td> <td> $cd  %  </td> </tr>  
        <tr> <td> Country Code   :   </td> <td> $coname  </td> </tr>  
        <tr> <td> City Name   :   </td> <td> $cityname  </td> </tr>   
        <tr> <td> Sun rise UTC  :   </td> <td> $rise  </td> </tr>   
        <tr> <td> Sun set UTC  :   </td> <td> $set  </td> </tr>       
        </table>";
         }
        ?>  
    </body>
</html>
