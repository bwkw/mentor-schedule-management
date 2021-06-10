@extends('layouts.app')

@section('home')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
        <title>Mentorカレンダー</title>
    </head>
    <body>
        <div>
            <div class="button">
            
                <h3><a href="/register">予定の登録</a></h3>
                
            </div>
        </div>

    </body>
</html>
@endsection
