@extends('layouts.app')


@section('content')
<div class="container">
<?php
    use Illuminate\Support\Facades\DB;
?>
    @if (Auth::user()->type=='admin' || Auth::user()->type=='teacher')
        <div class="przyciski d-flex">
            <form method="GET">
                <input class="me-2" type="submit" value="Dodaj ocenę" formaction="{{route('addGrades')}}">
                <input class="me-2" type="submit" value="Klasy" formaction="{{route('classes')}}">
                @if (Auth::user()->type=='admin')
                    <input class="me-2" type="submit" value="Wróć do menu admina" formaction="{{route('adminView')}}">
                @endif
            </form>
            <form method="GET">
<?php
    $class_name = "";
    $klasy = DB::select("SELECT * FROM `classes`");
    echo "<select class=\"me-2\" name=\"class_id\">";
    echo "<option value=\"\" disabled selected>Wybierz klasę</option>";
    foreach($klasy as $record){
        echo "<option value=\"".$record->id."\">".$record->name."</option>";
    }
    echo "</select>";
    echo "<input class=\"me-2\" type=\"submit\" value=\"Wybierz\">";
    if(isset($_GET['class_id'])){
        $klasy2 = DB::select("SELECT * FROM `classes` WHERE `id` =".$_GET['class_id']);
        foreach($klasy2 as $record){
            $class_name = $record->name;
        }
        echo "Wybrana klasa: ".$class_name;
    }
?>
            </form>
        </div>
        <div class="d-flex">
<?php
    if(isset($_GET['class_id'])){
        if(count(DB::select("SELECT * FROM `class_subject` WHERE `class_id` = ".$_GET['class_id']))>0){
            $subjects = DB::select("SELECT `subjects`.`id` as `subid`, `subjects`.`name` as `subname` FROM `classes` JOIN `class_subject` ON `classes`.`id` = `class_subject`.`class_id` JOIN `subjects` ON `subjects`.`id` = `class_subject`.`subject_id` WHERE `classes`.`id`= ".$_GET['class_id']);
?>
            <form method="GET">
<?php
            echo "<select class=\"mt-2 me-2\" name=\"subject_id\">";
            echo "<option value=\"\" disabled selected>Wybierz przedmiot</option>";
            foreach($subjects as $record){
                echo "<option value=\"".$record->subid."\">".$record->subname."</option>";
            }
            echo "</select>";
            echo "<input class=\"me-2\" type=\"submit\" value=\"Wybierz\">";
            if(isset($_GET['subject_id'])){
                $selected_subject = DB::select("SELECT * FROM `subjects` WHERE `id` = ".$_GET['subject_id']);
                $subname = "";
                foreach($selected_subject as $record){
                    $subname = $record->name;
                }
                echo "Wybrany przedmiot: ".$subname;
            }
            else{
                echo "Nie wybrano przedmiotu";
            }
            echo "<input type=\"hidden\" name=\"class_id\" value=\"".$_GET['class_id']."\">";
            echo "</form>";
            echo "</div>";
        }
        else{
            echo "</div>";
            echo "<p>Do tej klasy jeszcze nie zostały dodane przedmioty</p>";
        }
    }
    else{
        echo "</div>";
        echo "Nie wybrano klasy";
    }
?>
        <div class="dziennik row mt-3">
            <div class="uczniowie col-3">
                <h3 class="fw-bold">Uczniowie</h3>
<?php
    if(isset($_GET['class_id']) && isset($_GET['subject_id'])){
        $uczniowie = DB::select("SELECT * FROM `users` WHERE `class_id`=".$_GET['class_id']." AND `users`.`type`=\"student\"");
        foreach($uczniowie as $record){
            echo "<div class=\"subject_list\">".$record->name."</div>";
        }
    }
?>
            </div>
            <div class="oceny col-9">
                <h3 class="fw-bold">Oceny</h3>
<?php
    if(isset($_GET['class_id']) && isset($_GET['subject_id'])){
        foreach($uczniowie as $record){
            $oceny = DB::select("SELECT * FROM `grades` WHERE `subject_id` = ".$_GET['subject_id']." AND `user_id` = ".$record->id);
            echo "<div class=\"grades_list d-flex\">";
            foreach($oceny as $record2) {
                echo "<div class=\"gradeColor".$record2->weight."\">".$record2->value."</div>";
            }
            echo "</div>";
        }
    }
?>
            </div>
        </div>
        
    @else
        Brak dostępu
    @endif
</div>
@endsection
