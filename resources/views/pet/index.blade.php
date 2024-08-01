@extends('master')

@section('content')

    <div>
        <form action="/" method="GET">
            @csrf

            <div class="row">

                <label for="status">wybierz status</label>
                <div class="col-6">
                    
                    <select name="status" id="status" class="form-control">
                        <option {{ $status == "available" ? 'selected="selected"' : '' }} value="available">available</option>
                        <option {{ $status == "pending" ? 'selected="selected"' : '' }} value="pending">pending</option>
                        <option {{ $status == "sold" ? 'selected="selected"' : '' }} value="sold">sold</option>
                    </select>
                </div>
                
                <div class="col-6">
                    <button type="submit" class="btn btn-primary">załaduj</button>
                </div>
            </div>
            
        </form>

        <hr>

        <a class="btn btn-primary" href="/pet/create">dodaj nowe zwierzę</a>

        <hr>

        @if (session('flash'))
        
            <div class="alert alert-info">{{ session('flash') }}</div>
            <hr>
        @endif

        <div id="grid">
            @include("pet.grid")
        </div>
    </div>

@endsection