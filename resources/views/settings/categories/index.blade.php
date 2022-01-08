@extends("layouts.settings")

@section("title")
    <p class="fs-4 m-0">Liste des catégories</p>
@endsection

@section("button")
    <button type="button" class="btn btn-primary btn-md rounded-pill" data-bs-toggle="modal"
            data-bs-target="#addCategoryModal"><i class="fas fa-plus"></i> Ajouter une catégorie
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
            <th class="text-center" scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td class="text-center">
                    <a class="text-decoration-none" href="{{route('categories.edit', $category)}}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <span style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal{{$category->id}}">
                                <i class="fas fa-trash text-danger"></i>
                            </span>
                    <div class="modal fade" id="deleteCategoryModal{{$category->id}}" tabindex="-1"
                         aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('categories.destroy', $category)}}" method="post">
                                    @method("DELETE")
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteCategoryModalLabel">Etes vous sur de
                                            vouloir supprimer cette catégorie ?</h5>
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
        @if(!$categories->count())
            <tr>
                <td colspan="4">
                    <div class="alert alert-primary mt-3" role="alert">
                        Aucune catégorie trouvée
                    </div>
                </td>
            </tr>
        @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $categories->links() !!}
    </div>

    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('categories.store')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryLabel">Ajouter une catégorie</h5>
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
