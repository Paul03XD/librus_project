@extends('layouts.app')


@section('content')
<div class="container">
    @if (Auth::user()->type=='admin')
        <div class="navBox">
            <form method="get">     
                <input class="me-2" type="submit" value="Dodaj klasę" formaction="{{route('addClasses')}}">
                <input class="me-2" type="submit" value="Dodaj przedmiot" formaction="{{route('addSubjects')}}">
                <input class="me-2" type="submit" value="Przypisz ucznia do klasy" formaction="{{route('assignClass')}}">
                <input class="me-2" type="submit" value="Przypisz przedmiot" formaction="{{route('assignSubject')}}">

                <input class="me-2" type="submit" value="Użytkownicy" formaction="{{route('users')}}">
                <input class="me-2" type="submit" value="Szkoła" formaction="{{route('showSchool')}}">
            </form>
        </div>
    @else
        Brak dostępu
    @endif
</div>
@endsection