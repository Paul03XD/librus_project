@extends('layouts.app')

@section('content')
<div class="container">
    <?php
    use Illuminate\Support\Facades\DB;
    ?>
    <p>Klasa {{$name}}</p>
    @if (Auth::user()->type=='admin' || Auth::user()->type=='teacher')
        <div class="formBox mt-3 mb-3">
            <form method="post" action="{{route('createGrade',$name)}}">
                @csrf
                <p>Wybierz ocenę</p>
                <select class="col-1 me-3 mb-3" name="gradeValue" required>
                    <option value="6">6</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
                <p>Wybierz wagę</p>
                <select class="col-1 me-3 mb-3" name="gradeWeight" required>
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
        echo "<option value=\"\" disabled selected>Wybierz ucznia</option>";
        $wynik = DB::select("SELECT `users`.`id` as `users_id`,`users`.`name` as `users_name` FROM `users` JOIN `classes` ON `users`.`class_id`= `classes`.`id` WHERE `classes`.`name`=\"$name\" AND `users`.`type`=\"student\"");
        foreach ($wynik as $record){
            echo "<option value=".$record->users_id.">".$record->users_name."</option>";
        }
?>
                </select><br/>
                <p>Podaj przedmiot</p>
                <select class="me-3 mb-3" name="subjectsSelectList" required>
<?php
        echo "<option value=\"\" disabled selected>Wybierz przedmiot</option>";
        $wynik2 = DB::select("SELECT `subjects`.`id` as `subjectId`, `subjects`.`name` as `subjectName` FROM `subjects` JOIN `class_subject` ON `subjects`.`id` = `class_subject`.`subject_id` WHERE `class_subject`.`class_id` = \"".$name."\"");
        foreach($wynik2 as $record){
            echo "<option value=\"".$record->subjectId."\">".$record->subjectName."</option>";
        }
   
?>
                </select><br/>
                <input class="me-3 mb-3" type="submit" name="addSubject" value="Dodaj ocenę">
            </form>
        </div>
        <form method="get">
            <input type="submit" value="Oceny" formaction="{{route('grades',$name)}}">
        </form>
    
    @else
        Brak dostępu
    @endif
</div>
@endsection
