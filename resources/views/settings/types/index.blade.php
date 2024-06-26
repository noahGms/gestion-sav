@extends("layouts.settings")

@section("title")
    <p class="fs-4 m-0">Liste des types</p>
@endsection

@section("button")
    <button type="button" class="btn btn-primary btn-md rounded-pill" data-bs-toggle="modal"
            data-bs-target="#addTypeModal"><i class="fas fa-plus"></i> Ajouter un type
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
            <th scope="col">Catégorie</th>
            <th class="text-center" scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($types as $type)
            <tr>
                <td>{{$type->name}}</td>
                <td>{{optional($type->category)->name}}</td>
                <td class="text-center">
                    <a class="text-decoration-none" href="{{route('types.edit', $type)}}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <span style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteTypeModal{{$type->id}}">
                                <i class="fas fa-trash text-danger"></i>
                            </span>
                    <div class="modal fade" id="deleteTypeModal{{$type->id}}" tabindex="-1"
                         aria-labelledby="deleteTypeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('types.destroy', $type)}}" method="post">
                                    @method("DELETE")
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteTypeModalLabel">Etes vous sur de
                                            vouloir supprimer ce type ?</h5>
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
        @if(!$types->count())
            <tr>
                <td colspan="4">
                    <div class="alert alert-primary mt-3" role="alert">
                        Aucun type trouvé
                    </div>
                </td>
            </tr>
        @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $types->links() !!}
    </div>

    <div class="modal fade" id="addTypeModal" tabindex="-1" aria-labelledby="addTypeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('types.store')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTypeLabel">Ajouter un type</h5>
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
                            <label for="category_id" class="form-label">Catégorie</label>
                            <select class="form-select @error('category_id') is-invalid @enderror"
                                    aria-label="Catégorie" id="category_id" name="category_id">
                                <option value="" selected>Selectionner une catégorie</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">
                                {{ $errors->first('category_id') }}
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
