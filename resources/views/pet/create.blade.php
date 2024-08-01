@extends('master')

@section('content')

    <br>
    
    <div class="row">
        
        <div class="offset-3 col-6">
            <h2>Dadaj zwierzę</h2>
            
            <form action="/pet" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="name">imie</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label for="category">kategoria</label>
                    <input type="text" name="category" id="category" value="{{ old('category') }}" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label for="photoUrls">linki do zdjęć (jeden pod drugim)</label>
                    <textarea name="photoUrls" id="photoUrls" cols="30" rows="10" class="form-control">{{ old('photoUrls') }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="tags">tagi (odzielone przecinkami)</label>
                    <textarea name="tags" id="tags" cols="30" rows="10" class="form-control">{{ old('tags') }}</textarea>
                </div>
                
                {{-- <div class="mb-3">
                    <label for="status">status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="available">available</option>
                        <option value="pending">pending</option>
                        <option value="sold">sold</option>
                    </select>
                </div> --}}

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