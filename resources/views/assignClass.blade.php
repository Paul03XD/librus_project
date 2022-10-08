@extends('layouts.app')


@section('content')
<div class="container">
    
    @if (Auth::user()->type=='admin')
        <form method="post" action="{{ route('createAssignClass') }}">
            @csrf
            <h1>Przypisz ucznia do klasy</h1>
            <p>Wybierz ucznia</p>
            <select class="me-3 mb-3" name="usersSelectList" required>
<?php
    $wynik = DB::select("SELECT * FROM `users`");
    foreach($wynik as $record){
        echo "<option value=\"".$record->id."\">".$record->name."</option>";
    }
?>
            </select><br/>
            <p>Wybierz klasę</p>
            <select class="me-3 mb-3" name="classesSelectList" required>
<?php
    $wynik = DB::select("SELECT * FROM `classes`");
    foreach($wynik as $record){
        echo "<option value=\"".$record->id."\">".$record->name."</option>";
    }
?>
            </select><br/>
            <input class="mb-3"type="submit" value="Przypisz">
        </form>
        <form method="get">
            <input type="submit" value="Wróć" formaction="{{route('adminView')}}">
        </form>
        
    @else
        Brak dostępu
    @endif
</div>
@endsection