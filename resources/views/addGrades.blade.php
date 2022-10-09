@extends('layouts.app')

@section('content')
<div class="container">
    <?php
    use Illuminate\Support\Facades\DB;
    ?>
    @if (Auth::user()->type=='admin' || Auth::user()->type=='teacher')
        <form class="d-flex mb-3">
<?php
    $wynik = DB::select("SELECT * FROM `classes`");
    echo "<select class=\"me-2\" name=\"class_id\" required>";
    echo "<option value=\"\" disabled selected>Wybierz klasę</option>";
    foreach($wynik as $record){
        echo "<option value=\"".$record->id."\">".$record->name."</option>";
    }
    echo "</select>";
    echo "<input class=\"me-2\" type=\"submit\" value=\"Wybierz klasę\">";
?>
        </form>
        <form method="post" action="{{route('createGrade')}}">
            @csrf
            <p>Wybierz ocenę</p>
            <select class="me-3 mb-3" name="gradeValue" required>
                <option value="6">6</option>
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
            </select>
            <p>Wybierz wagę</p>
            <select class="me-3 mb-3" name="gradeWeight" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select><br/>
            <p>Dodaj opis</p>
            <input class="me-3 mb-3" type="text" name="gradeDescription" required><br/>
            <p>Wybierz ucznia</p>
            <select class="me-3 mb-3" name="usersSelectList" required>
<?php
    if(isset($_GET['class_id'])){
        echo "<option value=\"\" disabled selected>Wybierz ucznia</option>";
        $wynik = DB::select("SELECT * FROM `users` WHERE `class_id`=".$_GET['class_id']." AND `users`.`type`=\"student\"");
        foreach($wynik as $record){
            echo "<option value=\"".$record->id."\">".$record->name."</option>";
        }
    }
    else{
        echo "<option value=\"\" disabled selected>Nie wybrano klasy</option>";
    }
?>
    
            </select><br/>
            <p>Podaj przedmiot</p>
            <script>
                var index = document.getElementByName('usersSelectList').selectedIndex;
            </script>
            <select class="me-3 mb-3" name="subjectsSelectList" required>
<?php
    if(isset($_GET['class_id'])){
        echo "<option value=\"\" disabled selected>Wybierz przedmiot</option>";
        $wynik2 = DB::select("SELECT `subjects`.`id` as `subjectId`, `subjects`.`name` as `subjectName` FROM `subjects` JOIN `class_subject` ON `subjects`.`id` = `class_subject`.`subject_id` WHERE `class_subject`.`class_id` = ".$_GET['class_id']);
        foreach($wynik2 as $record){
            echo "<option value=\"".$record->subjectId."\">".$record->subjectName."</option>";
        }
    }
    else{
        echo "<option value=\"\" disabled selected>Nie wybrano klasy</option>";
    }
?>
            </select><br/>
            <input class="me-3 mb-3" type="submit" name="addSubject" value="Dodaj ocenę">
        </form>
        <form method="get">
            <input type="submit" value="Oceny" formaction="{{route('grades')}}">
        </form>
    
    @else
        Brak dostępu
    @endif
</div>
@endsection
