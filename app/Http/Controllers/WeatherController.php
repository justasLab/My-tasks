<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{

    /**
     * Display a weather index page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Get weather data
     *
     * @param \Illuminate\Http\Request $request
     * @return json
     */
    public function getWeather(Request $request)
    {
// Will return to the index page if the request is not ajax
        if (!$request->ajax())
            return redirect('/');

        $appid = $request->input('appid'); // api id
        $city = $request->input('city'); // city name
        // getting response from weather site
        $response = Http::get('api.openweathermap.org/data/2.5/weather?q=' . $city . '&units=metric&appid=' . $appid);

// will return an error if the request fails
        if ($response->failed())
            return response()->json('Oops, Something Went Wrong', 404);

        $data = $response->json();
        $result = []; // result array
        $timeZone = ($data['timezone']) / 3600; // time zone in hours

        $result['description'] = $data['weather'][0]['description'];
        $result['temp'] = $data['main']['temp'];
        $result['wind'] = $data['wind']['speed'];
        $result['sunrise'] = Carbon::createFromTimestamp($data['sys']['sunrise'])->setTimezone($timeZone)->toTimeString();
        $result['sunset'] = Carbon::createFromTimestamp($data['sys']['sunset'])->setTimezone($timeZone)->toTimeString();

        return response()->json($result);
    }


}
