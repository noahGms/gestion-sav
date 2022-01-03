@extends("layouts.settings")

@section("title")
    <p class="fs-4 mb-0">
        <a class="text-dark text-decoration-none" href="{{route('returns.index')}}">
            <i class="fas fa-arrow-left"></i>
        </a>
        <span>Modifier le moyen de retour n°{{$return->id}}</span>
    </p>
@endsection

@section("settings-content")
    <form action="{{route('returns.update', $return)}}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                   value="{{ old('name') ?? $return->name }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection
