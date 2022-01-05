@extends("layouts.settings")

@section("title")
    <p class="fs-4 m-0">Liste des états</p>
@endsection

@section("button")
    <button type="button" class="btn btn-primary btn-md rounded-pill" data-bs-toggle="modal"
            data-bs-target="#addStateModal"><i class="fas fa-plus"></i> Ajouter un état
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
            <th scope="col">Nom</th>
            <th class="text-center" scope="col">Couleur</th>
            <th class="text-center" scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($states as $state)
            <tr>
                <td>{{$state->name}}</td>
                <td class="text-center">
                            <span class="badge text-{{LightOrDarkColor::getTextColor($state->color)}}"
                                  style="background: {{$state->color}};">{{$state->color}}</span>
                </td>
                <td class="text-center">
                    <a class="text-decoration-none" href="{{route('states.edit', $state)}}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <span style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteStateModal">
                                <i class="fas fa-trash text-danger"></i>
                            </span>
                    <div class="modal fade" id="deleteStateModal" tabindex="-1"
                         aria-labelledby="deleteStateModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('states.destroy', $state)}}" method="post">
                                    @method("DELETE")
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteStateModalLabel">Etes vous sur de
                                            vouloir supprimer cette état ?</h5>
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
                </td>
            </tr>
        @endforeach
        @if(!$states->count())
            <tr>
                <td colspan="4">
                    <div class="alert alert-primary mt-3" role="alert">
                        Aucun état trouvé
                    </div>
                </td>
            </tr>
        @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $states->links() !!}
    </div>

    <div class="modal fade" id="addStateModal" tabindex="-1" aria-labelledby="addStateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('states.store')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStateLabel">Ajouter un état</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   id="name" value="{{old('name')}}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Couleur</label>
                            <input class="form-control form-control-color @error('color') is-invalid @enderror" name="color" id="color"
                                   type="color" value="{{old('color')}}"/>
                            @error('color')
                            <div class="invalid-feedback">
                                {{ $errors->first('color') }}
                            </div>
                            @enderror
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
