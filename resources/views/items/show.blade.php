@extends("layouts.base")

@section("content")
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <p class="fs-4 mb-0">
                <a class="text-dark text-decoration-none" href="{{route('items.index')}}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <span>I'item n°{{$item->id}}</span>
            </p>
            <a href="{{route('items.edit', $item)}}" class="btn btn-primary btn-md rounded-pill">
                <i class="fas fa-plus"></i> Modifier
            </a>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card w-100 h-100">
                    <div class="card-body">
                        <h5 class="card-title mb-3" style="font-weight: bold;">Création</h5>
                        <div class="row">
                            <div class="mb-3">
                                <p class="text-decoration-underline">Client :</p>
                                <span>{{optional($item->customer)->fullname}} - {{optional(optional($item->customer)->address)->full_address}}</span>
                            </div>
                            <div class="mb-3">
                                <p class="text-decoration-underline">Etat :</p>
                                <span>{{optional($item->state)->name}}</span>
                                <span class="badge text-{{LightOrDarkColor::getTextColor(optional($item->state)->color)}}" style="background: {{optional($item->state)->color}};">
                                    {{optional($item->state)->color}}
                                </span>
                            </div>
                            <div class="mb-3">
                                <p class="text-decoration-underline">Commentaire sur l'état :</p>
                                <pre>{{$item->comment_state}}</pre>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <p class="text-decoration-underline">Date d'intervention :</p>
                                <pre>{{$item->intervention_date}}</pre>
                            </div>
                            <div class="col">
                                <p class="text-decoration-underline">Moyen d'intervention :</p>
                                <p>{{optional($item->intervention)->name}}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <p class="text-decoration-underline">Moyen de dépot :</p>
                                <p>{{optional($item->depot)->name}}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <p class="text-decoration-underline">Date de retour :</p>
                                <p>{{$item->return_date}}</p>
                            </div>
                            <div class="col">
                                <p class="text-decoration-underline">Moyen de retour :</p>
                                <p>{{optional($item->returnMdl)->name}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mt-sm-3 mt-md-0 mt-lg-0">
                <div class="card w-100 h-100">
                    <div class="card-body">
                        <h5 class="card-title mb-3" style="font-weight: bold;">Machine</h5>

                        <div class="row mb-3">
                            <div class="col-12">
                                <p class="text-decoration-underline">Type :</p>
                                <p>{{optional($item->type)->name}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <p class="text-decoration-underline">Marque :</p>
                                <p>{{optional($item->brand)->name}}</p>
                            </div>
                            <div class="col">
                                <p class="text-decoration-underline">Modèle :</p>
                                <p>{{$item->model}}</p>
                            </div>
                            <div class="col">
                                <p class="text-decoration-underline">Numéro de série :</p>
                                <p>{{$item->serial_number}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <p class="text-decoration-underline">Défaut signalé :</p>
                                <pre>{{$item->defaults}}</pre>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title mb-3" style="font-weight: bold;">Informations</h5>

                        <div class="row mb-3">
                            <div class="col-12">
                                <p class="text-decoration-underline">Observations :</p>
                                <pre>{{$item->observations}}</pre>
                            </div>
                            <div class="col-12">
                                <p class="text-decoration-underline">Réparations :</p>
                                <pre>{{$item->reparations}}</pre>
                            </div>
                            <div class="col-12">
                                <p class="text-decoration-underline">Commentaires :</p>
                                <pre>{{$item->observations}}</pre>
                            </div>
                            <div class="col-12">
                                <p class="text-decoration-underline">Communications :</p>
                                <pre>{{$item->communications}}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card w-100 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0" style="font-weight: bold;">Techniciens</h5>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#addItemUserModal">Ajouter un technicien</button>
                        </div>
                        <div class="row">
                            <div>
                                @if(!$item->users->count())
                                    <div class="alert alert-primary mb-0" role="alert">
                                        Aucun technicien
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="table-light">
                                            <tr>
                                                <th scope="col">Nom complet</th>
                                                <th class="text-center" scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($item->users as $user)
                                                <tr>
                                                    <td>{{$user->fullname}}</td>
                                                    <td class="text-center">
                                                        <span style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteItemUserModal{{$user->id}}">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </span>
                                                        <div class="modal fade" id="deleteItemUserModal{{$user->id}}" tabindex="-1"
                                                             aria-labelledby="deleteItemUserModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form action="{{route('items.users.destroy', [$item, $user])}}" method="post">
                                                                        @method("DELETE")
                                                                        @csrf
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="deleteItemUserModalLabel">Etes vous sur de
                                                                                vouloir supprimer ce technicien ?</h5>
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
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card w-100 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0" style="font-weight: bold;">Pièces</h5>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#addItemPartModal">Ajouter une pièce</button>
                        </div>
                        <div class="row">
                            <div>
                                @if(!$item->parts->count())
                                    <div class="alert alert-primary mb-0" role="alert">
                                        Aucune pièce
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="table-light">
                                            <tr>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Prix</th>
                                                <th scope="col">Lien</th>
                                                <th class="text-center" scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($item->parts as $part)
                                                <tr>
                                                    <td>{{$part->name}}</td>
                                                    <td>{{$part->price}}</td>
                                                    <td>{{$part->link}}</td>
                                                    <td class="text-center">
                                                        <span style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteItemPartModal{{$part->id}}">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </span>
                                                        <div class="modal fade" id="deleteItemPartModal{{$part->id}}" tabindex="-1"
                                                             aria-labelledby="deleteItemPartModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form action="{{route('items.parts.destroy', [$item, $part])}}" method="post">
                                                                        @method("DELETE")
                                                                        @csrf
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="deleteItemPartModalLabel">Etes vous sur de
                                                                                vouloir supprimer cette pièce ?</h5>
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
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card w-100 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0" style="font-weight: bold;">Documents</h5>
                            <button type="button" class="btn btn-outline-primary">Ajouter un document</button>
                        </div>
                        <div class="row">
                            <div>
                                @if(!$item->files->count())
                                    <div class="alert alert-primary mb-0" role="alert">
                                        Aucun document
                                    </div>
                                @endif
                                @foreach($item->files as $file)
                                    <img height="100" width="100" src="{{Storage::url($file->path)}}" alt="">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addItemUserModal" tabindex="-1" aria-labelledby="addItemUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('items.users.store', $item)}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addItemUserLabel">Ajouter un technicien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Technicien</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" aria-label="Selectionner un technicien">
                                <option value="" selected>Selectionner un technicien</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->fullname}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="invalid-feedback">
                                {{ $errors->first('user_id') }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addItemPartModal" tabindex="-1" aria-labelledby="addItemPartLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('items.parts.store', $item)}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addItemPartLabel">Ajouter une pièce</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input class="form-control @error('name') is-invalid @enderror" name="name"
                                   id="name"
                                   value="{{old('name')}}"
                                   type="text" placeholder="Nom" />
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Prix</label>
                            <input class="form-control @error('price') is-invalid @enderror" name="price"
                                   id="price"
                                   value="{{old('price')}}"
                                   type="number" placeholder="Prix" />
                            @error('price')
                            <div class="invalid-feedback">
                                {{ $errors->first('price') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Lien</label>
                            <input class="form-control @error('link') is-invalid @enderror" name="link"
                                   id="link"
                                   value="{{old('link')}}"
                                   type="text" placeholder="Lien" />
                            @error('link')
                            <div class="invalid-feedback">
                                {{ $errors->first('link') }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
