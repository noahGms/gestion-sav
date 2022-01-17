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
        <div class="mt-3 w-50">
            <button id="passwordFormBtn" onclick="showPasswordForm()" class="w-100 btn btn-primary">Modifier mon mot de passe</button>
            <div id="passwordForm" class="mt-3" style="display: none;">
                <div class="card w-100 p-4 rounded">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="fs-4 text-center m-0">Modifier mon mot de passe</p>
                        <button onclick="closePasswordForm()" type="button" class="btn-close" aria-label="Close"></button>
                    </div>
                    <form action="{{route('profile.password.update')}}" method="post">
                        @method("PUT")
                        @csrf
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Ancien mot de passe</label>
                            <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="old_password"
                                   value="{{ old('old_password') }}">
                            @error('old_password')
                            <div class="invalid-feedback">
                                {{ $errors->first('old_password') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Nouveau mot de passe de confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
        <script>
            const div = document.getElementById('passwordForm')
            div.style.display = 'block'

            const button = document.getElementById('passwordFormBtn')
            button.style.display = 'none'
        </script>
    @endif

    <script>
        function showPasswordForm() {
            const div = document.getElementById('passwordForm')
            div.style.display = 'block'

            const button = document.getElementById('passwordFormBtn')
            button.style.display = 'none'
        }

        function closePasswordForm() {
            const div = document.getElementById('passwordForm')
            div.style.display = 'none'

            const button = document.getElementById('passwordFormBtn')
            button.style.display = 'block'
        }
    </script>
@endsection
