@extends('layouts.app')


@section('content')
<div class="container">
<?php
    use Illuminate\Support\Facades\DB;
?>
    @if (Auth::user()->type=='admin' || Auth::user()->type=='student')
        <div class="przyciski d-flex">
            <form method="get">
            @if (Auth::user()->type=='admin')
                <input class="me-2" type="submit" value="Wróć do menu admina" formaction="{{route('adminView')}}">
            @endif
            </form>
<?php
    $user_id = Auth::user()->id;
    $uczen = "";
    $klasa = "";
    $class_id = "";
    $checkifnull = false;
    foreach (DB::select("SELECT * FROM `users` WHERE `users`.`id`=".$user_id." LIMIT 1") as $record){
        if($record->class_id == null){
            $checkifnull = true;
        }
    }
    if($checkifnull==false){
        foreach(DB::select("SELECT `users`.`name` as `student_name`,`classes`.`name` as `class_name`,`class_id` FROM `users` JOIN `classes` ON `users`.`class_id` = `classes`.`id` WHERE `users`.`id`=".$user_id." LIMIT 1") as $record){
            $uczen = $record->student_name;
            $klasa = $record->class_name;
            $class_id = $record->class_id;
            echo "Zalogowany uczeń: ".$uczen." z klasy ".$klasa;
        }
    }
    else{
        foreach(DB::select("SELECT `users`.`name` as `student_name` FROM `users` WHERE `users`.`id`=".$user_id." LIMIT 1") as $record){
            $uczen = $record->student_name;
        }
        echo "Zalogowany uczeń: ".$uczen." bez klasy";
    }
?>  
            </form>
        </div>
        <div class="dziennik row mt-3">
            <div class="przedmioty col-3">
                <h3 class="fw-bold">Przedmioty</h3>
<?php
    if($class_id!=NULL){
        $wynik2 = DB::select("SELECT `subjects`.`id` as `subjectId`, `subjects`.`name` as `subjectName` FROM `subjects` JOIN `class_subject` ON `subjects`.`id` = `class_subject`.`subject_id` WHERE `class_subject`.`class_id` = ".$class_id." ORDER BY `subjects`.`name` ASC");
        foreach($wynik2 as $record){
            echo "<div class=\"subject_list\">".$record->subjectName."</div>";
        }
    }
?>
            </div>
            <div class="oceny col-9">
                <h3 class="fw-bold">Oceny</h3>
<?php
    if($class_id!=NULL){
        foreach($wynik2 as $record){
            $wynik3 = DB::select("SELECT * FROM `grades` WHERE `subject_id`=$record->subjectId AND `user_id`=".$user_id);
            echo "<div class=\"grades_list d-flex\">";
            foreach($wynik3 as $record2) {
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
