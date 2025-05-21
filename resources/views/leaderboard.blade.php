<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
</head>
<body>
    <h2>Top Scores</h2>
    <ul>
        @foreach ($leaderboard as $entry)
            <li>{{ $entry->word }} - {{ $entry->score }} points</li>
        @endforeach
    </ul>
</body>
</html>
