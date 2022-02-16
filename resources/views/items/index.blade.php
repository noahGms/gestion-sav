@extends("layouts.base")

@section("content")
<div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-between align-items-center">
            <p class="fs-4 mb-0 d-flex align-items-center">Liste des items
                <span class="badge text-dark fw-bold bg-light ms-2">{{$itemsCount}}</span>
                <button id="filterBtn" class="btn btn-sm btn-light ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fas fa-filter"></i>
                    <i class="fa fa-chevron-up"></i>
                    <i class="fa fa-chevron-down"></i>
                </button>
            </p>
        </div>
        <a href="{{route('items.create')}}" class="btn btn-primary btn-md">
            <i class="fas fa-plus"></i> Ajouter un item
        </a>
    </div>

    <div class="collapse mt-3" id="collapseExample">
        <div class="card card-body">
            <form id="filterForm" class="row" action="{{route('items.index')}}" method="get">
                <div class="col">
                    <label for="state_id" class="form-label">Etat</label>
                    <select onchange="filterForm.submit()" id="state_id" name="state_id" class="form-select" aria-label="Etat">
                        <option value="">Tous</option>
                        @foreach($states as $state)
                        <option value="{{$state->id}}" {{request()->query('state_id') == $state->id ? 'selected' : ''}}>{{$state->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="brand_id" class="form-label">Marque</label>
                    <select onchange="filterForm.submit()" id="brand_id" name="brand_id" class="form-select" aria-label="Marque">
                        <option value="">Tous</option>
                        @foreach($brands as $brand)
                        <option value="{{$brand->id}}" {{request()->query('brand_id') == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="type_id" class="form-label">Type</label>
                    <select onchange="filterForm.submit()" id="type_id" name="type_id" class="form-select" aria-label="Type">
                        <option value="" selected>Tous</option>
                        @foreach($types as $type)
                        <option value="{{$type->id}}" {{request()->query('type_id') == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="with_archived" class="form-label">Afficher</label>
                    <select onchange="filterForm.submit()" id="with_archived" name="with_archived" class="form-select" aria-label="Afficher">
                        <option value="all" {{request()->query('with_archived') == 'all' ? 'selected' : ''}}>Les deux</option>
                        <option value="no" {{request()->query('with_archived') == 'no' ? 'selected' : ''}} {{request()->query('with_archived') == null ? 'selected' : ''}}>Les items</option>
                        <option value="yes" {{request()->query('with_archived') == 'yes' ? 'selected' : ''}}>Les items archivés</option>
                    </select>
                </div>
                <div class="col">
                    <label for="intervention_date" class="form-label">Date d'intervention</label>
                    <select onchange="filterForm.submit()" id="intervention_date" name="intervention_date" class="form-select" aria-label="Date d'intervention">
                        <option value="asc" {{request()->query('intervention_date') == 'asc' ? 'selected' : ''}}>Ascendant</option>
                        <option value="desc" {{request()->query('intervention_date') == 'desc' ? 'selected' : ''}}>Descendant</option>
                    </select>
                </div>
                <div class="row mt-3">
                    <a href="javascript:" onclick="location.href = '/items'" class="text-dark text-decoration-none">
                        <i class="fas fa-times"></i> Renitialiser les filtres
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table mt-4 border table-striped">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th class="text-center" scope="col">Type</th>
                    <th class="text-center" scope="col">Machine</th>
                    <th class="text-center" scope="col">Client</th>
                    <th class="text-center" colspan="2" scope="col">Etat</th>
                    <th class="text-center" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{optional($item->intervention_date)->format('d/m/Y')}}</td>
                    <td class="text-center">{{optional($item->type)->name}}</td>
                    <td class="text-center">{{optional($item->brand)->name}} - {{$item->model}}</td>
                    <td class="text-center">{{optional($item->customer)->fullname}}</td>
                    <td class="text-center  text-{{LightOrDarkColor::getTextColor(optional($item->state)->color)}}" style="background: {{optional($item->state)->color}};">{{$item->comment_state}}</td>
                    <td class="text-center  text-{{LightOrDarkColor::getTextColor(optional($item->state)->color)}}" style="background: {{optional($item->state)->color}};">{{optional($item->state)->name}}</td>
                    <td class="text-center">
                        @if(!$item->archived_at)
                        <form id="archiveForm" onclick="archiveForm.submit()" style="cursor: pointer;" class="d-inline" action="{{route('items.archive', $item)}}" method="post">
                            @csrf
                            <span class="text-primary" data-toggle="tooltip" data-placement="top" title="Archiver">
                                <i class="fas fa-folder"></i>
                            </span>
                        </form>
                        @else
                        <form id="unarchiveForm" onclick="unarchiveForm.submit()" style="cursor: pointer;" class="d-inline" action="{{route('items.unarchive', $item)}}" method="post">
                            @csrf
                            <span class="text-primary" data-toggle="tooltip" data-placement="top" title="Unarchiver">
                                <i class="fas fa-folder-open"></i>
                            </span>
                        </form>
                        @endif
                        <a class="text-decoration-none" href="{{route('items.show', $item)}}">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="text-decoration-none" href="{{route('items.edit', $item)}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <span style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteItemModal{{$item->id}}">
                            <i class="fas fa-trash text-danger"></i>
                        </span>
                        <div class="modal fade" id="deleteItemModal{{$item->id}}" tabindex="-1" aria-labelledby="deleteItemModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{route('items.destroy', $item)}}" method="post">
                                        @method("DELETE")
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteItemModalLabel">Etes vous sur de
                                                vouloir supprimer cet item ?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                @if(!$items->count())
                <tr>
                    <td colspan="8">
                        <div class="alert alert-primary mt-3" role="alert">
                            Aucune item trouvé
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {!! $items->withQueryString()->links() !!}
    </div>
</div>
@endsection
