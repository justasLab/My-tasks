<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</head>
<body>

<p>
<div class="alert alert-danger" role="alert"></div>
</p>

{!! Form::open(['url' => '/', 'id' => 'weather-form']) !!}
<div class="form-group">
    {!! Form::label('appid', 'Insert your api id: ') !!}
    {!! Form::text('appid', '', ['required' => 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('city', 'City: ') !!}
    {!! Form::text('city', '', ['required' => 'required']) !!}
</div>
{!! Form::submit('Show weather', ['class' => 'btn btn-success']) !!}
{!! Form::close() !!}

<div class="city-tabs">
    <ul class="nav nav-tabs"></ul>
</div>

<div class="tab-content"></div>
</body>
</html>
