@extends('layouts.app')


@section('content')
<div class="container">
    <div class="navBox przyciski d-flex">
        <form method="GET">
            @if (Auth::user()->type=='admin')
                <input class="me-2" type="submit" value="Wróć do menu admina" formaction="{{route('adminView')}}">
            @endif
        </form>
    </div>
    <div class = "classList mt-3">
<?php
    $wynik = DB::select("SELECT c.name, COUNT(u.class_id) as number FROM classes c LEFT JOIN users u ON c.id=u.class_id GROUP BY c.name ORDER BY c.name ASC");
?>
        <div class = "rekord_row row">
            <h3 class="col-4 fw-bold">Klasa</h3>
            <h3 class="col-4 fw-bold">Ilość uczniów</h3>
            <h3 class="col-4 fw-bold">Przyciski</h3>
        </div>
<?php
    foreach($wynik as $record){
        echo "<div class = \"rekord_row row d-flex\">";
            echo "<div class=\"col-4 rekord_element\"><p>".$record->name."</p></div>";
            echo "<div class=\"col-4 rekord_element\"><p>".$record->number."</p></div>";
            echo "<div class=\"col-4 rekord_element\">";
                echo "<form method=\"get\">";
                    echo "<input type=\"submit\" value=\"Przejdź do klasy\" formaction=\"".route('grades', $record->name)."\">";
                echo "</form>";
            echo "</div>";
        echo "</div>";
    }
?>
        </div> 
    </div>
</div>
@endsection