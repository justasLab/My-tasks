var cityArray = [];
$(document).ready(function () {
    $(document).on("submit", "#weather-form", function (e) {
        e.preventDefault();
        var url = $(this).attr('action'); // url from form
        var method = $(this).attr('method'); // form method
        var data = $(this).serialize(); // form data
        var city = $("#weather-form #city").val().toUpperCase(); // city name from text input

        $("div.alert-danger").html(""); // clear alert content

        // checking that the search is not repeated
        if (cityArray.includes(city)) {
            $("a#link_" + city).click();
        } else {
            cityArray.push(city); // a new item is added to the array

            // ajax call
            $.ajax({
                type: method,
                url: url,
                data: data,
                dataType: "json",
                success: function (result) {
                    $(".city-tabs .nav a").removeClass("active"); // removeing active class from all city tabs
                    var newTab = '<li><a class="active" data-toggle="tab" href="#' + city + '" id="link_' + city + '">' + city + '</a></li>'; // new list item
                    $(".city-tabs .nav").html(newTab + $(".city-tabs .nav").html()); // insert a new city tab into list

                    $("div.tab-content div.tab-pane").removeClass("active"); // removeing active class

                    var dataList = generateList(city, result); // weather data list
                    $("div.tab-content").html(dataList + $("div.tab-content").html()); // insert weather data into div.tab-content
                },
                error: function (xhr) {
                    // an alert message is displayed if there is any error
                    $("div.alert-danger").html(JSON.parse(xhr.responseText));
                }
            });
        }

    });
});


// function is used to create a weather data table
function generateList(city, data) {
    var content = '<div id="' + city + '" class="tab-pane fade in active">';
    content += '<ul><li>Weather description - ' + data.description + '</li>';
    content += '<li>Current temperature - ' + data.temp + ' °C</li>';
    content += '<li>Wind - ' + data.wind + ' m/s</li>';
    content += '<li>Sunrise - ' + data.sunrise + '</li>';
    content += '<li>Sunset - ' + data.sunset + '</li>';
    content += '</ul></div>';

    return content;
}
