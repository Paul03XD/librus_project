@extends('layouts.app')


@section('content')
<div class="container">
<?php
    use Illuminate\Support\Facades\DB;
?>
    <form method="post">
        @csrf
<?php
    $wynik = DB::select("SELECT * FROM `users`");
    echo "<select class=\"me-2\" name=\"user_id\" required>";
    echo "<option value=\"\" disabled selected>Wybierz użytkownika</option>";
    foreach ($wynik as $record) {
        echo "<option value=".$record->id.">".$record->username."</option>";
    }
    echo "</select>";
?>
        <select class="me-2" name="uprawnienia" required>
            <option value="" disabled selected>Wybierz rolę:</option>
            <option value="admin">Admin</option>
            <option value="teacher">Nauczyciel</option>
            <option value="student">Uczeń</option>
        </select>
        <input type="submit" value="Nadaj uprawnienie" formaction="{{route('createAssignType')}}">
    </form>
    <form class="mt-2" method="GET">
        @if (Auth::user()->type=='admin')
            <input class="me-2" type="submit" value="Wróć do listy użytkowników" formaction="{{route('users')}}">
        @endif
    </form>
</div>
@endsection