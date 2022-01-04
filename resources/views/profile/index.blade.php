@extends("layouts.base")

@section("content")
    <div class="d-flex flex-column align-items-center justify-content-center">
        <div class="card w-50 p-4 rounded">
            <p class="fs-4 text-center">Modifier mon compte</p>
            <form action="{{route('profile.update')}}" method="post">
                @method("PUT")
                @csrf
                <div class="mb-3">
                    <label for="lastname" class="form-label">Nom</label>
                    <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" id="lastname"
                           value="{{ old('lastname') ?? auth()->user()->lastname }}">
                    @error('lastname')
                    <div class="invalid-feedback">
                        {{ $errors->first('lastname') }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="firstname" class="form-label">Prénom</label>
                    <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" id="firstname"
                           value="{{ old('firstname') ?? auth()->user()->firstname }}">
                    @error('firstname')
                    <div class="invalid-feedback">
                        {{ $errors->first('firstname') }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>
    </div>
@endsection
