@extends('master')

@section('content')
<br>
    
<div class="row">
    
    <div class="offset-3 col-6">
        <h2>Edytuj zwierzę</h2>
        
        <form action="/pet/{{ $pet['id'] }}" method="POST">
            @method('PUT')

            @csrf
            
            <div class="mb-3">
                <label for="name">Imie</label>
                <input type="text" name="name" id="name" value="{{ $pet['name'] }}" class="form-control">
            </div>
            
            <div class="mb-3">
                <label for="category">kategoria</label>
                <input type="text" name="category" id="category" value="{{ isset($pet['category']) ? $pet['category']['name'] : null }}" class="form-control">
            </div>
            
            <div class="mb-3">
                <label for="photoUrls">linki do zdjęć (jeden pod drugim)</label>
                <textarea name="photoUrls" id="photoUrls" cols="30" rows="10" class="form-control">{{ implode("\n", $pet['photoUrls']) }}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="tags">tagi</label>
                <textarea name="tags" id="tags" cols="30" rows="10" class="form-control">{{ implode(', ', array_column($pet['tags'], 'name')) }}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="status">status</label>
                <select name="status" id="status" class="form-control">
                    <option {{ $pet['status'] == 'available' ? 'selected="selected"' : '' }}" value="available">available</option>
                    <option {{ $pet['status'] == 'pending' ? 'selected="selected"' : '' }}" value="pending">pending</option>
                    <option {{ $pet['status'] == 'sold' ? 'selected="selected"' : '' }}" value="sold">sold</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

        @if ($errors->any())
            <hr>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <hr>

        <a class="btn btn-secondary" href="/">powrót</a>

    </div>
</div>

@endsection