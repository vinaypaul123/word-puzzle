
@extends('layout')

@section('content')
         <h2>Top Students by Total Score</h2>
<table>
    <thead>
        <tr>
            <th>Student</th>
            <th>Total Score</th>
            <th>Words Submitted</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($leaderboard as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->submissions_sum_score }}</td>
                <td>
                    <table>
                        <thead>
                            <tr>
                                <th>Word</th>
                                <th>Score</th>
                                <th>Remaining Letters</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student->submissions as $submission)
                                <tr>
                                    <td>{{ $submission->word }}</td>
                                    <td>{{ $submission->score }}</td>
                                    <td>
                                        {{ is_array($submission->remaining_letters)
                                            ? implode(',', $submission->remaining_letters)
                                            : $submission->remaining_letters }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
