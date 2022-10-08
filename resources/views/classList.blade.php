@extends('layouts.app')


@section('content')
<div class="container">
    <?php
        use Illuminate\Support\Facades\DB;
    ?>
    @if (Auth::user()->type=='admin' || Auth::user()->type=='teacher')
        <div class="przyciski d-flex">
            <form method="get">
                <input class="me-2" type="submit" value="Oceny" formaction="{{route('grades')}}">
            </form>
        </div>
        <div class="userList row mt-3">
<?php
    
    $wynik = DB::select("SELECT * FROM `classes`");
?>
        <h1>Lista klas</h1>
<?php
    foreach ($wynik as $record){
        echo "<div>".$record->name."</div>";
    }
?>
    @else
        Brak dostępu
    @endif
</div>
@endsection
