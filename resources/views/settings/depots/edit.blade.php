@extends("layouts.settings")

@section("title")
    <p class="fs-4">
        <a class="text-dark text-decoration-none" href="{{route('depots.index')}}">
            <i class="fas fa-arrow-left"></i>
        </a>
        <span>Modifier le moyen de dépot n°{{$depot->id}}</span>
    </p>
@endsection

@section("settings-content")
    <form action="{{route('depots.update', $depot)}}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                   value="{{ old('name') ?? $depot->name }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection
