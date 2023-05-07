<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
    <link rel="stylesheet" href="weather.css">

</head>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        background: url(https://source.unsplash.com/1600x900/?landscape);
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        background-size: cover;
        color: white;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif
    }

    h2 {
        font-size: 40px;
        margin-bottom: 2px;
        margin-top: -10px;
    }

    h1 {
        font-size: 40px;
        margin-top: -10px;
        margin-bottom: 3px;
    }

    .date {
        padding-left: 5px;
        font-size: 17px;
        margin-top: 0px;
        margin-bottom: 40px;
    }

    .container1 {
        background: rgba(132, 135, 132, 0.84);
        padding: 20px;
        margin: 20px;
        border-radius: 20px;
        width: 100%;
        max-width: 420px;
    }

    .search {
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .weather {
        font-size: 18px;
        margin: 25px;
        margin-bottom: 10px;
    }

    input {
        border-radius: 15px;
        border: transparent;
        padding: 6px;
        margin: 15px;
        width: 100%;
        background: rgba(182, 178, 178, 0.61);
        color: white;
        font-family: inherit;
    }

    button {
        border-radius: 100px;
        margin: 2px;
        height: 25px;
        width: 25px;
        padding: 6px;
        border: transparent;
        background: rgba(182, 178, 178, 0.61);
    }

    button:hover {
        cursor: pointer;
        background: rgb(213, 213, 213);
        transition: 0.5s;
    }

    .btn {
        border-radius: 30px;
        margin: 10px;
        height: 35px;
        width: 370px;
        padding: 10px;
        border: transparent;
        background: rgba(182, 178, 178, 0.61);
        color: white;
        font-family: inherit;
        font-size: 15px;
    }

    .data {
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .des {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding-bottom: 25px;
        text-transform: capitalize;
        background: rgba(106, 107, 108, 0.55);
        border-radius: 20px;
        margin-left: 105px;
        margin-right: 105px;
        margin-bottom: 30px;
        padding: 16px;
        padding-top: 20px;
        padding-bottom: 28px;
    }

    @media screen and (max-width:350px) {
        .des {
            display: flex;
            flex-direction: column;
            padding-bottom: 25px;
            text-transform: capitalize;
            background: rgba(106, 107, 108, 0.459);
            border-radius: 10px;
            margin-left: 10px;
            margin-right: 105px;
            margin-bottom: 30px;
            padding: 16px;
            padding-top: 20px;
            padding-bottom: 28px;
        }

    }

    .max-min_temp {
        font-size: 14px;
        margin-bottom: 10px;

    }
</style>

<body>
    <?php
    include 'current_BristinaPrajapati_2330707.php';
    ?>

    <div class="container1">
        <form class="search" action="">
            <input type="text" class="search-bar" placeholder="Search city or country.." name="location">
            <button type="submit"><ion-icon name="search-outline"></ion-icon></button>
        </form>

        <!-- <div class="time">time</div> -->


        <div class="weather">
            <h2 class="city">
                <?php echo $name; ?>
            </h2>
            <div class="date">
                <?php echo $date; ?>
            </div>
            <h1 class="temp">
                <?php echo $temp; ?> °C
            </h1>
            <div class="max-min_temp">
                <div class="max">Max_temp:
                    <?php echo $max_temp; ?> °C
                </div>
                <div class="min">Min_temp:
                    <?php echo $min_temp; ?> °C
                </div>
            </div>
            <div class="des">
                <img src="<?php echo "https://openweathermap.org/img/wn/{$icon}.png"; ?>">
                <div class="description">
                    <?php echo $description; ?>
                </div>
            </div>
            <div class="wind">Wind Speed:
                <?php echo $windSpeed; ?> m/s
            </div>
            <div class="humidity">Humidity:
                <?php echo $humidity; ?>%
            </div>
            <div class="clouds">Clouds:
                <?php echo $clouds; ?>%
            </div>
            <div class="pressure">Pressure:
                <?php echo $pressure; ?> hPa
            </div>
        </div>

        <form action="http://localhost/weather/history_BristinaPrajapati_2330707.php/" method="POST">
            <button type="submit" class="btn">View past 7 days weather</button>
        </form>
    </div>

</body>

</html>


</div>
</div>
</body>

</html>