@extends("layouts.base")

@section("content")
    <p class="fs-4">
        <a class="text-dark text-decoration-none" href="{{route('states.index')}}">
            <i class="fas fa-arrow-left"></i>
        </a>
        <span>Modifier l'état n°{{$state->id}}</span>
    </p>
    <form action="{{route('states.update', $state)}}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                   value="{{ old('name') ?? $state->name }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Couleur</label>
            <input class="form-control @error('color') is-invalid @enderror" name="color" id="color" type="text"
                   value="{{ old('color') ?? $state->color }}"/>
            @error('color')
            <div class="invalid-feedback">
                {{ $errors->first('color') }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection
