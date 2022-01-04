@extends("layouts.base")

@section("content")
    <div class="d-flex flex-column justify-content-center align-items-center vh-100">
        <h2 class="mb-4">Se connecter</h2>
        <form action="{{route('login.handle')}}" method="post">
            @csrf
            @if($errors)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{$error}}
                    </div>
                @endforeach
            @endif
            <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input id="password" name="password" type="password" class="form-control">
            </div>
            <div class="form-check mb-3">
                <input id="remember_me" name="remember_me" type="checkbox" value="1" class="form-checkbox-input">
                <label for="remember_me" class="form-check-label me-3">Se souvenir de moi</label>
            </div>
            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-primary">Se connecter</button>
                <p class="mt-2">Contacter l'administateur si vous n'avez pas de compte</p>
            </div>
        </form>
    </div>
@endsection
