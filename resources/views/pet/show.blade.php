@extends('master')

@section('content')

    <br>
    
    <div class="row">
        
        <div class="offset-3 col-6">
            <h2>{{ $pet['name'] }}</h2>
    
            <table class="table">
                <tr>
                    <th>kategoria</th>
                    <td>{{ isset($pet['category']) ? $pet['category']['name'] : '--' }}</td>
                </tr>
                <tr>
                    <th>tagi</th>
                    <td>{{ isset($pet['tags']) ? implode(', ', array_column($pet['tags'], 'name')) : '--' }}</td>
                </tr>
                <tr>
                    <th>status</th>
                    <td>{{ $pet['status'] }}</td>
                </tr>
            </table>

            <a class="btn btn-secondary" href="/">powrót</a>
            <a class="btn btn-primary" href="/pet/edit/{{ $pet['id'] }}">edytuj</a>
        </div>
    </div>

@endsection