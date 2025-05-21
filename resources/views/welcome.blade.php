@extends('layout')

@section('content')

    <h1>Welcome to Word Puzzle Game</h1>
    <a style="color:#fff;text-decoration:none" href="{{ route('puzzle.name') }}"><button class="btn btn-primary mb-2">Start Puzzle</button></a><br>
     <a style="color:#fff;text-decoration:none" href="{{ route('leaderboard') }}"><button class="btn btn-primary">Leader Board </button></a>
@extends('layout')

@section('content')
