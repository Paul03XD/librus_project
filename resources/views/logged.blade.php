@extends('layouts.app')


@section('content')
<div class="container">
    @if (Auth::user()->type=='admin')
        <h1>Witamy admina!</h1>
        <form method="GET">
            <input class="me-2" type="submit" value="Przejdź menu admina" formaction="{{route('adminView')}}">
        </form>
    @elseif (Auth::user()->type=='teacher')
        <h1>Witamy nauczyciela!</h1>
        <form method="GET">
            <input class="me-2" type="submit" value="Przejdź do klas" formaction="{{route('school')}}">
        </form>
    @elseif (Auth::user()->type=='student')
        <h1>Witamy ucznia!</h1>
        <form method="GET">
            <input class="me-2" type="submit" value="Przejdź do ocen" formaction="{{route('usergrades')}}">
        </form>
    @else
        <h1>Jesteś zalogowany, ale nie masz przypisanej roli</h1>
    @endif
</div>
@endsection