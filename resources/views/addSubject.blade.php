@extends('layouts.app')

@section('content')
<div class="container">
    
    @if (Auth::user()->type=='admin')
        <form method="post" action="{{route('createSubject')}}">
            @csrf
            <p>Podaj nazwę przedmiotu</p>
            <input class="me-3 mb-3" type="text" name="subname" required><br/>
            <input class="me-3 mb-3" type="submit" name="addSubject" value="Dodaj przedmiot">
        </form>
        <form method="get">
            <input type="submit" value="Wróć" formaction="{{route('adminView')}}">
        </form>
        
    @else
        Brak dostępu
    @endif
</div>
@endsection
