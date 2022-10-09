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
            <input class="mb-2" type="submit" value="Dodaj przedmiot" formmethod="GET" formaction="{{route('addSubjects')}}">
<?php
        }
        else{
            echo "<select name=\"subject_id\" class=\"mb-3\">";
            echo "<option value=\"\" disabled selected>Wybierz przedmiot</option>";
            if(count($wynik2)>0){
                foreach($wynik2 as $record2){
                    echo "<option value=\"".$record2->id."\">".$record2->name."</option>";
                }
            }
            else{
                echo "<option value=\"\" disabled selected>Brak przedmiotów</option>";
            }
            echo "</select><br/>";
            
            echo "<select name=\"class_id\" class=\"mb-3\">";
            echo "<option value=\"\" disabled selected>Wybierz klasę</option>";
            if(count($wynik)){
                foreach($wynik as $record){
                    echo "<option value=\"".$record->id."\">".$record->name."</option>";
                }
            }
            else{
                echo "<option value=\"\" disabled selected>Brak klas</option>";
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