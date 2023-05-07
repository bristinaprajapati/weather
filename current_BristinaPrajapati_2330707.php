<?php
include 'connect_BristinaPrajapati_2330707.php';

$apiKey = "3032cb7451e0adddefe889d6cef2b6df";
$defaultCity = "Omaha";
$defaultCountry = 'US';

// Check if a location has been searched 
if (isset($_GET['location'])) {
    $location = $_GET['location'];
    getWeatherData($location, $apiKey);
}else{
    $location = "{$defaultCity},{$defaultCountry}";
    getWeatherData($location, $apiKey);
}

function getWeatherData($location, $apiKey) {
    include 'connect_BristinaPrajapati_2330707.php';
    $city = $location; //Setting the city and country variable to value of location when any location is entered
    $country = $location;
    $weatherurl = "http://api.openweathermap.org/data/2.5/weather?q={$city},{$country}&units=metric&APPID={$apiKey}";
    $weatherJson = file_get_contents($weatherurl);

    if ($weatherJson) {
        // Success  display or store the weather data
        $weatherData = json_decode($weatherJson, true);
    
        // Extracting the country code from the location data
        $country = $weatherData['sys']['country'];
        //Displaying weather data
        $id = $weatherData['id'];
        $name = $weatherData['name'];
        $iconn = $weatherData['weather'][0]['icon'];
        $description = $weatherData['weather'][0]['description'];
        $temp = $weatherData['main']['temp'];
        $max_temp = $weatherData['main']['temp_max'];
        $min_temp = $weatherData['main']['temp_min'];
        $humidity = $weatherData['main']['humidity'];
        $windSpeed = $weatherData['wind']['speed'];
        $clouds = $weatherData['clouds']['all'];
        $pressure = $weatherData['main']['pressure'];
        $dt = $weatherData['dt'];
    
        $date = date("Y-m-d", $dt);
        $icon_url = "https://openweathermap.org/img/wn/{$iconn}.png";
    
        // Append the weather icon to the weather condition variable
        $icon = " <img src='{$icon_url}' alt='Weather Icon'>";
    
        // Delete all existing data from the weather table
        $query = "DELETE FROM current";
        mysqli_query($con, $query);
    
        // Insert the data into the database
        $sqll = "INSERT INTO current (city,date,temperature,max_temperature,min_temperature,iconn,weather_description,wind_speed,humidity,clouds,pressure,id) VALUES ('$name','$date', '$temp','$max_temp', '$min_temp', '$iconn', '$description','$windSpeed','$humidity','$clouds','$pressure','$id')";
    
        if (!mysqli_query($con, $sqll)) {
            echo "Error inserting weather data for $date into the database: ";
        }
    
    } else {
        // Error handle
        echo "Error fetching weather data";
    }
}

// Select the latest weather data from the database
$query = "SELECT * FROM current ORDER BY id DESC LIMIT 1";
$result = mysqli_query($con, $query);

if ($result) {
    // Display the weather data
    $row = mysqli_fetch_assoc($result);
    $name = $row['city'];
    $date = $row['date'];
    $temp = $row['temperature'];
    $max_temp = $row['max_temperature'];
    $min_temp = $row['min_temperature'];
    $icon = $row['iconn'];
    $description = $row['weather_description'];
    $windSpeed = $row['wind_speed'];
    $humidity = $row['humidity'];
    $clouds = $row['clouds'];
    $pressure = $row['pressure'];

} else {
    echo "Error fetching weather data from the database: " . mysqli_error($con);
}


?>








        