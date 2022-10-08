@extends('layouts.app')

@section('content')
<div class="container">
    
    @if (Auth::user()->type=='admin')
        <form>
            @csrf
            <h1 class="mb-3">Przypisz przedmiot do klasy</h1>
<?php
    $wynik = DB::select("SELECT * FROM `classes`");
    if(count($wynik)>0){
        $wynik2 = DB::select("SELECT * FROM `subjects`");
        if(count($wynik2)==0){
            echo "Brak przedmiotów do przypisania<br/>";
?>
            <input type="submit" value="Dodaj przedmiot" formmethod="GET" formaction="{{route('addSubjects')}}">
<?php
        }
        else{
            echo "<p>Wybierz przedmiot</p>";
            echo "<select name=\"subject_id\" class=\"mb-3\">";
            foreach($wynik2 as $record2){
                echo "<option value=\"".$record2->id."\">".$record2->name."</option>";
            }
            echo "</select><br/>";
            
            echo "<p>Wybierz klasę</p>";
            echo "<select name=\"class_id\" class=\"mb-3\">";
            foreach($wynik as $record){
                echo "<option value=\"".$record->id."\">".$record->name."</option>";
            }
            echo "</select><br/>";
?>
            <input class="mb-3" type="submit" value="Przypisz" formmethod="POST" formaction="{{route('createAssignSubject')}}">
<?php
        }
    }
?>
        </form>
        <form method="get">
            <input type="submit" value="Wróć" formaction="{{route('adminView')}}">
        </form>
    @else
        Brak dostępu
    @endif
</div>
@endsection