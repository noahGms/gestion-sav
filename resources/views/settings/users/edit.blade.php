@extends("layouts.settings")

@section("title")
    <p class="fs-4">
        <a class="text-dark text-decoration-none" href="{{route('users.index')}}">
            <i class="fas fa-arrow-left"></i>
        </a>
        <span>Modifier l'utilisateur n°{{$user->id}}</span>
    </p>
@endsection

@section("settings-content")
    <form action="{{route('users.update', $user)}}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="lastname" class="form-label">Nom</label>
            <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" id="lastname"
                   value="{{ old('lastname') ?? $user->lastname }}">
            @error('lastname')
            <div class="invalid-feedback">
                {{ $errors->first('lastname') }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="firstname" class="form-label">Prénom</label>
            <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" id="firstname"
                   value="{{ old('firstname') ?? $user->firstname }}">
            @error('firstname')
            <div class="invalid-feedback">
                {{ $errors->first('firstname') }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection
