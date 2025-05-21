@extends('layout')

@section('content')

        <h2>Enter Your name</h2>
            <form method="POST" action="{{ route('submission.submitname') }}">
                @csrf
                <input  type="text" name="name" required>
                <button type="submit">Submit</button>
            </form>


@endsection

