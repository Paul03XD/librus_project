@extends('layouts.app')


@section('content')
<div class="container">
    <div class="przyciski d-flex">
        <form method="GET">
            @if (Auth::user()->type=='admin')
                <input class="me-2" type="submit" value="Wróć do menu admina" formaction="{{route('adminView')}}">
            @endif
        </form>
    </div>
    <div class = "mt-2 table border-2 border border-dark">
        <div class = "row d-flex">
            <div class = "col-2 text-center" style = "margin: auto 0;">
                Klasa
            </div>
            <div class = "col-2 text-center" style = "margin: auto 0;">
                Ilość uczniów
            </div>
            <div class = "col-8 text-center" style = "margin: auto 0;">
                Przycisk
            </div>
        </div>
        <?php
        $wynik = DB::select("SELECT c.name, COUNT(u.class_id) as number FROM classes c LEFT JOIN users u ON c.id=u.class_id GROUP BY c.name ORDER BY c.name ASC");
        foreach($wynik as $record){
        ?>
        <div class = "row d-flex">
            <div class = "col-2 text-center" style = "margin: auto 0;">
            <?php
            echo $record->name;
            ?>
            </div>
            <div class = "col-2 text-center" style = "margin: auto 0;">
            <?php
            echo $record->number;
            ?>
            </div>
            <div class = "col-8 text-center">
                <form method="get" action="{{ route('grades', $record->name) }}">
                    <input class="me-2" type="submit" value="Przejdź do klasy">
                </form>
            </div>
        </div>
            <?php
        }
            ?>
        </div> 
    </div>
</div>
@endsection