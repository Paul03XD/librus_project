@extends('layouts.app')


@section('content')
<div class="container">
<?php
    use Illuminate\Support\Facades\DB;
?>
    @if (Auth::user()->type=='admin')
        <div class="przyciski d-flex">
            <form class="d-flex" method="get">  
                <input class="me-2" type="submit" value="Przypisz typ użytkownika" formaction="{{route('assignType')}}">
                <input class="me-2" type="submit" value="Wróć" formaction="{{route('adminView')}}"> 
            </form>
        </div>
        <div class="userList mt-3">
<?php
    $wynik = DB::select("SELECT * FROM `users` ORDER BY CASE
    WHEN `type` = 'admin' THEN 1
    WHEN `type` = 'teacher' THEN 2
    WHEN `type` = 'student' THEN 3
    ELSE 4
    END ASC");
?>
            <div class="rekord_row row">
                <div class="col-2">
                    <h3 class="fw-bold">Username</h3>
                </div>
                <div class="col-2">
                    <h3 class="fw-bold">Role</h3>
                </div>
                <div class="col-2">
                    <h3 class="fw-bold">Użytkownik</h3>
                </div>
                <div class="col-3">
                    <h3 class="fw-bold">E-mail</h3>
                </div>
                <div class="col-3">
                    <h3 class="fw-bold">Klasa</h3>
                </div>
            </div>
<?php
    foreach ($wynik as $record) {
        echo "<div class=\"rekord_row row\">";
            echo "<div class=\"col-2\">".$record->username."</div>";
            echo "<div class=\"col-2\">".$record->type."</div>";
            echo "<div class=\"col-2\">".$record->name."</div>";
            echo "<div class=\"col-3\">".$record->email."</div>";
        if($record->class_id==NULL) {
            echo "<div class=\"col-3\">Brak</div>";
        }
        else {
            foreach(DB::select("SELECT `classes`.`name` FROM `users` join `classes` on `users`.`class_id` = `classes`.`id` WHERE `users`.`id`=$record->id LIMIT 1") as $record2){
                echo "<div class=\"col-3\">".$record2->name."</div>";
            }
        }
        echo "</div>";
    }
?>
    @else
        Brak dostępu
    @endif
</div>
@endsection
