@extends("layouts.base")

@section("content")
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <p class="fs-4 m-0">Liste des moyens de retour</p>
                <button type="button" class="btn btn-primary btn-md rounded-pill" data-bs-toggle="modal"
                        data-bs-target="#addReturnModal"><i class="fas fa-plus"></i> Ajouter un moyen de retour
                </button>
            </div>
        </div>
        <div class="card-body">
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
                    <th class="text-center" scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($returns as $return)
                    <tr>
                        <td>{{$return->name}}</td>
                        <td class="text-center">
                            <a class="text-decoration-none" href="{{route('returns.edit', $return)}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <span style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteReturnModal">
                                <i class="fas fa-trash text-danger"></i>
                            </span>
                            <div class="modal fade" id="deleteReturnModal" tabindex="-1"
                                 aria-labelledby="deleteReturnModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{route('returns.destroy', $return)}}" method="post">
                                            @method("DELETE")
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteReturnModalLabel">Etes vous sur de
                                                    vouloir supprimer ce moyen de retour ?</h5>
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
                @if(!$returns->count())
                    <tr>
                        <td colspan="4">
                            <div class="alert alert-primary mt-3" role="alert">
                                Aucun moyen de retour trouvé
                            </div>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $returns->links() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="addReturnModal" tabindex="-1" aria-labelledby="addReturnLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('returns.store')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addReturnLabel">Ajouter un moyen de retour</h5>
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
