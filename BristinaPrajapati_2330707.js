let weather = { 
    defaultCity: "Omaha",
    defaultCountry: "US",
    "apiKey": "3032cb7451e0adddefe889d6cef2b6df",
    fetchWeather: function (city, country) { 
        fetch("http://api.openweathermap.org/data/2.5/weather?q=" + city + "," + country + "&units=metric&APPID=" + this.apiKey)
            .then((response) => response.json())  //converting response object to json data
            .then((data) => this.displayWeather(data))
            .catch((error) => {
                console.log("Error fetching weather data:", error);
            }); 
    },

    displayWeather: function (data) {
        const { name } = data;
        const { icon, description } = data.weather[0];
        const { temp, humidity,pressure,temp_min,temp_max } = data.main;
        const { speed } = data.wind;
        const { all } = data.clouds;
        const { dt } = data;

        const date = new Date(dt * 1000);
        const options = { weekday: "long", year: "numeric", month: "long", day: "numeric" };
        const dateString = date.toLocaleDateString(undefined, options);

        document.querySelector(".date").innerText = dateString;
        document.querySelector(".city").innerText = name;
        document.querySelector(".icon").src = "https://openweathermap.org/img/wn/" + icon + ".png";
        document.querySelector(".description").innerText = description;
        document.querySelector(".temp").innerText = temp + "°C";
        document.querySelector(".humidity").innerText = "Humidity: " + humidity + " % ";
        document.querySelector(".wind").innerText = "Wind speed: " + speed + " km/h";
        document.querySelector(".clouds").innerText = "Clouds: " + all + " % ";
        document.querySelector(".max").innerText = "min_temp " + temp_min + " °C";;
        document.querySelector(".min").innerText = "max_temp " + temp_max + " °C";
        document.querySelector(".pressure").innerText = "Pressure: " + pressure + " mb";

        setTimeout(function(){
        document.body.style.backgroundImage ="url('https://source.unsplash.com/1600x900/?"+ name +"')"
    },50)
    },
    search: function () {
        const city = document.querySelector(".search-bar").value;
        if (city) {
            this.fetchWeather(city);
        } else {
            this.fetchWeather();
        }
    },
};
document.querySelector(".search").addEventListener("click", function () {
    weather.search();
});
document.querySelector(".search-bar").addEventListener("keyup", function (event) {
    if (event.key == "Enter") {
        weather.search();
    }
});

weather.fetchWeather("Omaha", "US");
