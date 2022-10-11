@extends('layouts.app')


@section('content')
<div class="container">
<?php
    use Illuminate\Support\Facades\DB;
?>
    @if (Auth::user()->type=='admin' || Auth::user()->type=='teacher')
        <div class="navBox d-flex">
            <form method="GET">
                <input class="me-2" type="submit" value="Dodaj ocenę" formaction="{{route('addGrade',$name)}}">
                <input class="me-2" type="submit" value="Wróć do klas" formaction="{{route('showSchool')}}">
                @if (Auth::user()->type=='admin')
                    <input class="me-2" type="submit" value="Wróć do menu admina" formaction="{{route('adminView')}}">
                @endif
            </form>
<?php
    $class_id = "";
    $klasy = DB::select("SELECT * FROM `classes` WHERE `name` = \"$name\"");
    foreach($klasy as $record){
        $class_id = $record->id;
    }
?>
        </div>
        <p>Klasa {{$name}}</p>
        <div class="d-flex">
<?php
    if($class_id!=""){
        if(count(DB::select("SELECT * FROM `class_subject` WHERE `class_id` = ".$class_id))>0){
            $subjects = DB::select("SELECT `subjects`.`id` as `subid`, `subjects`.`name` as `subname` FROM `classes` JOIN `class_subject` ON `classes`.`id` = `class_subject`.`class_id` JOIN `subjects` ON `subjects`.`id` = `class_subject`.`subject_id` WHERE `classes`.`id`= ".$class_id);
?>
            <form method="GET">
<?php
            echo "<select class=\"mt-2 me-2\" name=\"subject_id\" required>";
            echo "<option value=\"\" disabled selected>Wybierz przedmiot</option>";
            foreach($subjects as $record){
                echo "<option value=\"".$record->subid."\">".$record->subname."</option>";
            }
            echo "</select>";
            echo "<input class=\"me-2\" type=\"submit\" value=\"Wybierz\" formaction=".route('grades',$name).">";
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
            echo "<input type=\"hidden\" name=\"class_id\" value=\"".$class_id."\">";
            echo "</form>";
            echo "</div>";
        }
        else{
            echo "</div>";
            echo "<p>Do tej klasy jeszcze nie zostały dodane przedmioty</p>";
        }
?>
        <div class="dziennik row mt-3">
            <div class="uczniowie col-3">
                <h3 class="fw-bold">Uczniowie</h3>
<?php
        $uczniowie = DB::select("SELECT * FROM `users` WHERE `class_id`=".$class_id." AND `users`.`type`=\"student\"");
        if(count($uczniowie)>0){
            foreach($uczniowie as $record){
                echo "<div class=\"subject_list\">".$record->name."</div>";
            }
        }
        else{
            echo "Brak uczniów w tej klasie";
        }
        echo "</div>";
        if(isset($_GET['subject_id'])){
?>
            <div class="oceny col-9">
                <h3 class="fw-bold">Oceny</h3>
<?php
            foreach($uczniowie as $record){
                $oceny = DB::select("SELECT * FROM `grades` WHERE `subject_id` = ".$_GET['subject_id']." AND `user_id` = ".$record->id);
                echo "<div class=\"grades_list d-flex\">";
                foreach($oceny as $record2) {
                    echo "<div class=\"gradeColor".$record2->weight."\">".$record2->value."</div>";
                }
                echo "</div>";
            }
        }

    
    }
    else{
        echo "</div>";
        echo "Klasa nie istnieje";
    }
?>
            </div>
        </div>
        
    @else
        Brak dostępu
    @endif
</div>
@endsection
