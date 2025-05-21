<!DOCTYPE html>
<html>
<head>
    <title>Play Puzzle</title>
</head>
<body>
    <h2>Puzzle: {{ $puzzle->puzzle }}</h2>
    <form method="POST" action="{{ route('submission.submit') }}">
        @csrf
        <input type="hidden" name="student_id" value="{{ $student->id }}">
        <input type="hidden" name="puzzle_id" value="{{ $puzzle->id }}">
        <input type="text" name="word" required>
        <button type="submit">Submit</button>
    </form>

 <a href="{{ route('leaderboard') }}">Leader Board</a>
</body>
</html>
