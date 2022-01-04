@extends("layouts.base")

@section("content")
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <p class="fs-4 mb-0">
                <a class="text-dark text-decoration-none" href="{{route('customers.index')}}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <span>Ajouter un client</span>
            </p>
        </div>
        <form class="mt-4 w-75" action="{{route('customers.store')}}" method="post">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="lastname" class="form-label">Nom</label>
                    <input class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                           id="lastname"
                           type="text" value="{{old('lastname')}}"/>
                    @error('lastname')
                    <div class="invalid-feedback">
                        {{ $errors->first('lastname') }}
                    </div>
                    @enderror
                </div>
                <div class="col">
                    <label for="firstname" class="form-label">Prénom</label>
                    <input class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                           id="firstname"
                           type="text" value="{{old('firstname')}}"/>
                    @error('firstname')
                    <div class="invalid-feedback">
                        {{ $errors->first('firstname') }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                       value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Téléphone fixe</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone"
                       value="{{ old('phone') }}">
                @error('phone')
                <div class="invalid-feedback">
                    {{ $errors->first('phone') }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="mobile1" class="form-label">Téléphone portable 1</label>
                <input type="text" name="mobile1" class="form-control @error('mobile1') is-invalid @enderror" id="mobile1"
                       value="{{ old('mobile1') }}">
                @error('mobile1')
                <div class="invalid-feedback">
                    {{ $errors->first('mobile1') }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="mobile2" class="form-label">Téléphone portable 2</label>
                <input type="text" name="mobile2" class="form-control @error('mobile2') is-invalid @enderror" id="mobile2"
                       value="{{ old('mobile2') }}">
                @error('mobile2')
                <div class="invalid-feedback">
                    {{ $errors->first('mobile2') }}
                </div>
                @enderror
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="street_number" class="form-label">Numéro de la rue</label>
                    <input class="form-control @error('street_number') is-invalid @enderror" name="street_number"
                           id="street_number"
                           type="text" value="{{old('street_number')}}"/>
                    @error('street_number')
                    <div class="invalid-feedback">
                        {{ $errors->first('street_number') }}
                    </div>
                    @enderror
                </div>
                <div class="col">
                    <label for="street_name" class="form-label">Nom de la rue</label>
                    <input class="form-control @error('street_name') is-invalid @enderror" name="street_name"
                           id="street_name"
                           type="text" value="{{old('street_name')}}"/>
                    @error('street_name')
                    <div class="invalid-feedback">
                        {{ $errors->first('street_name') }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="zip_code" class="form-label">Code postal</label>
                    <input class="form-control @error('zip_code') is-invalid @enderror" name="zip_code"
                           id="zip_code"
                           type="text" value="{{old('zip_code')}}"/>
                    @error('zip_code')
                    <div class="invalid-feedback">
                        {{ $errors->first('zip_code') }}
                    </div>
                    @enderror
                </div>
                <div class="col">
                    <label for="city" class="form-label">Ville</label>
                    <input class="form-control @error('city') is-invalid @enderror" name="city"
                           id="city"
                           type="text" value="{{old('city')}}"/>
                    @error('city')
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
