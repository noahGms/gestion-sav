@extends("layouts.settings")

@section("title")
    <p class="fs-4 m-0">Liste des utilisateurs</p>
@endsection

@section("button")
    <button type="button" class="btn btn-primary btn-md rounded-pill" data-bs-toggle="modal"
            data-bs-target="#addUserModal"><i class="fas fa-plus"></i> Ajouter un utilisateur
    </button>
@endsection

@section("settings-content")
    @if($errors)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                Une erreur est survenue !
            </div>
        @endforeach
    @endif

    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">Nom d'utilisateur</th>
            <th class="text-center" scope="col">Nom</th>
            <th class="text-center" scope="col">Prénom</th>
            <th class="text-center" scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->username}}</td>
                <td class="text-center">{{$user->lastname}}</td>
                <td class="text-center">{{$user->firstname}}</td>
                <td class="text-center">
                    @if(!$user->is_god)
                        <a class="text-decoration-none" href="{{route('users.edit', $user)}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <span style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteUserModal">
                                <i class="fas fa-trash text-danger"></i>
                            </span>
                        <div class="modal fade" id="deleteUserModal" tabindex="-1"
                             aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{route('users.destroy', $user)}}" method="post">
                                        @method("DELETE")
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteUserModalLabel">Etes vous sur de
                                                vouloir supprimer cet utilisateur ?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Annuler
                                            </button>
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <span class="text-danger">Aucune actions est permise</span>
                    @endif
                </td>
            </tr>
        @endforeach
        @if(!$users->count())
            <tr>
                <td colspan="4">
                    <div class="alert alert-primary mt-3" role="alert">
                        Aucun utilisateur trouvé
                    </div>
                </td>
            </tr>
        @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $users->links() !!}
    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('users.store')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserLabel">Ajouter un utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nom d'utilisateur</label>
                            <input type="text" name="username"
                                   class="form-control @error('username') is-invalid @enderror"
                                   id="username" value="{{old('username')}}">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $errors->first('username') }}
                            </div>
                            @enderror
                        </div>
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
                            <label for="password" class="form-label">Mot de passe</label>
                            <input class="form-control @error('password') is-invalid @enderror" name="password"
                                   id="password"
                                   type="password"/>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Mot de passe de confirmation</label>
                            <input class="form-control" name="password_confirmation" id="password_confirmation"
                                   type="password"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
