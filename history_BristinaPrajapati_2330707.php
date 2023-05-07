<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>


    <style>
        body {
            background: rgb(213, 213, 213);
        }

        .display {
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgb(209, 232, 197);
            margin: 30px;
            padding: 10px;
            border-radius: 20px;

        }

        table {

            width: 100%;
            max-width: 100%;
            background-color: transparent;
            border-collapse: collapse;
            box-shadow: rgba(182, 178, 178, 0.61);
        }


        th {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            background-color: rgba(182, 178, 178, 0.61);
            font-weight: bold;
        }

        td {
            padding: 3px;
            text-align: center;

        }
    </style>
</head>

<?php
// include database connection file
include 'connect_BristinaPrajapati_2330707.php';

$API_KEY = "3032cb7451e0adddefe889d6cef2b6df ";
$city = "Omaha";
$country = "US";

// if (isset($_GET['location'])) {
//     $location = $_GET['location'];
// } else {
//     $location = "{$city},{$country}";
// }



//  Check if a location has been searched 
// if (isset($_GET['location'])) {
//     $location = $_GET['location'];
    
// }else{
//     $location = "{$city},{$country}";
    
// }

function getHistory($city,$country, $start, $end, $API_KEY){
    
    $url = "https://history.openweathermap.org/data/2.5/history/city?q={$city},{$country}&type=hour&start={$start}&end={$end}&units=metric&appid={$API_KEY}";
    $response = file_get_contents($url);
    return json_decode($response, true);
}

// prepare dates for past 7 days 
$today = time();
$week_ago = strtotime('-7 days', $today);
$start_date = date('Y-m-d\TH:i:s', $week_ago);
$end_date = date('Y-m-d\TH:i:s', $today);


// echo "Fetching weather data for {$city} from {$start_date} to {$end_date} <br>";
// truncate weather table
$sql_truncate = "TRUNCATE TABLE `weather_data`.`weather`";
if (!mysqli_query($con, $sql_truncate)) {
    echo "Error truncating weather table: " . mysqli_error($con) . "<br>";
}


// fetch weather data for each day
for ($i = 1; $i < 8; $i++) {
    $start = strtotime("midnight -$i day", $today);
    $end = strtotime("midnight -" . ($i - 1) . " day", $today) - 1;
    $date = date('Y-m-d', $start);
    $data = getHistory($city,$country, $start, $end, $API_KEY);

    if (!empty($data['list'])) {
        // extract the weather data you want to store
        $weather_condition = $data['list'][0]['weather'][0]['description'];
        $temperature = $data['list'][0]['main']['temp'];
        $min_temperature = $data['list'][0]['main']['temp_min'];
        $max_temperature = $data['list'][0]['main']['temp_max'];
        $humidity = $data['list'][0]['main']['humidity'];
        $weather_icon = $data['list'][0]['weather'][0]['icon'];
        $wind_speed =$data['list'][0]['wind']['speed'];

        //Construct the URL for the weather icon
        $icon_url = "https://openweathermap.org/img/wn/{$weather_icon}.png";

        // Append the weather icon to the weather condition variable
        $icon = " <img src='{$icon_url}' alt='Weather Icon'>";

        // insert weather data into database
        $sql = "INSERT IGNORE INTO `weather` (`date`, `weather_condition`, `temperature`, `min_temperature`, `max_temperature`, `humidity`, `icon_code`,`wind`)
            VALUES ('$date', '$weather_condition', '$temperature', '$min_temperature', '$max_temperature', '$humidity', '$weather_icon','$wind_speed')";

        if (!mysqli_query($con, $sql)) {
            echo "Error inserting weather data: " . mysqli_error($con) . "<br>";
        }
    }
}


// select weather data from database
$sql_select = "SELECT * FROM `weather` ORDER BY `date` DESC";
$result = mysqli_query($con, $sql_select);

?>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card_head">
                    <h2 class="display">Past seven days weather data</h2>
                    </div>

                    <!-- displaying weather data in a table -->
                    <table class="table" border="1" cellspacing="0">
                        <tr>
                            <th>Date</th>
                            <th>Weather_condition</th>
                            <th>Temperature</th>
                            <th>Max_Temperature</th>
                            <th>Min_Temperature</th>
                            <th>Humidity</th>
                            <th>Wind_speed<th>
                        </tr>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td>
                                    <?php echo $row['date']; ?>
                                </td>
                                <td>
                                    <img src="<?php echo $icon_url; ?>" alt="Weather Icon">
                                    <?php echo $row['weather_condition']; ?>
                                </td>

                                <td>
                                    <?php echo $row['temperature']; ?>°C
                                </td>
                                <td>
                                    <?php echo $row['max_temperature']; ?>°C
                                </td>
                                <td>
                                    <?php echo $row['min_temperature']; ?>°C
                                </td>
                                <td>
                                    <?php echo $row['humidity']; ?>%
                                </td>
                                <td>
                                    <?php echo $row['wind']; ?>m/s
                                </td>
                            </tr>
                        <?php } ?>
                    </table>


                </div>
            </div>
        </div>
    </div>
</body>

</html>