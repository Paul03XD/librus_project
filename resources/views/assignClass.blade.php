@extends('layouts.app')


@section('content')
<div class="container">
    
    @if (Auth::user()->type=='admin')
        <div class="formBox mt-3 mb-3">
            <form method="post" action="{{ route('createAssignClass') }}">
                @csrf
                <p>Przypisz ucznia do klasy</p>
                <select class="me-3 mb-3" name="usersSelectList" required>
<?php
    $wynik = DB::select("SELECT * FROM `users` WHERE `type` = 'student'");
    if(count($wynik)>0){  
        echo "<option value=\"\" disabled selected>Wybierz ucznia</option>";
        foreach($wynik as $record){
            echo "<option value=\"".$record->id."\">".$record->name."</option>";
        }
    }
    else{
        echo "<option value=\"\" disabled selected>Brak uczniów</option>";
    }
?>
                </select><br/>
                <select class="me-3 mb-3" name="classesSelectList" required>
<?php
    $wynik = DB::select("SELECT * FROM `classes`");
    if(count($wynik)>0){
        echo "<option value=\"\" disabled selected>Wybierz klasę</option>";
        foreach($wynik as $record){
            echo "<option value=\"".$record->id."\">".$record->name."</option>";
        }
    }
    else{
        echo "<option value=\"\" disabled selected>Brak klas</option>";
    }
?>
                </select><br/>
                <input type="submit" value="Przypisz">
            </form>
        </div>
        <form method="get">
            <input type="submit" value="Wróć" formaction="{{route('adminView')}}">
        </form>
    @else
        Brak dostępu
    @endif
</div>
@endsection