@extends('layouts.app')

@section('content')
<div class="container">
<?php
?>
    
    @if (Auth::user()->type=='admin')
        <form method="post">
            @csrf
            <h1>Dodawanie klasy</h1>
            <p>Podaj nazwę klasy</p>
            <input class="me-3 mb-3" type="text" name="classname" required><br/>
            <input class="me-3 mb-3" type="submit" name="addClass" value="Dodaj klasę" formaction="{{route('createClass')}}">
        </form>

        <form method="get">
            <input type="submit" value="Wróć" formaction="{{route('adminView')}}">
        </form>
    
    @else
        Brak dostępu
    @endif
</div>
@endsection
