@extends('layout')

@section('content')


        <h2>Puzzle: dgeftoikbvxuaa</h2>

            <form method="POST" action="{{ route('submissionvalue.submit') }}">
                @csrf
                <input type="hidden" name="student_id" value="{{ $student->id }}">
                <input type="hidden" name="puzzle_id" value="{{ $puzzle->id }}">
                <input type="text"  name="word" required>
                <button type="submit">Submit</button>
            </form>

    <a href="{{ route('endgame') }}">End Game</a><br>


@endsection

