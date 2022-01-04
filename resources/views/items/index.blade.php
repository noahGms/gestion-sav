@extends("layouts.base")

@section("content")
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center">
                <p class="fs-4 mb-0">Liste des items</p>
            </div>
            <a href="{{route('items.create')}}" class="btn btn-primary btn-md rounded-pill">
                <i class="fas fa-plus"></i> Ajouter un item
            </a>
        </div>
        <div class="table-responsive">
            <table class="table mt-4">
                <thead>
                <tr class="table-dark">
                    <th scope="col">Date</th>
                    <th class="text-center" scope="col">Type</th>
                    <th class="text-center" scope="col">Machine</th>
                    <th class="text-center" scope="col">Client</th>
                    <th class="text-center" scope="col">Etat</th>
                    <th class="text-center" scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->intervention_date}}</td>
                        <td class="text-center">{{optional($item->type)->name}}</td>
                        <td class="text-center">{{optional($item->brand)->name}} - {{$item->model}}</td>
                        <td class="text-center">{{$item->mobile1}}</td>
                        <td class="text-center">{{optional(optional($item->customer)->address)->full_address}}</td>
                        <td class="text-center">
                            <a class="text-decoration-none" href="{{route('items.show', $item)}}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="text-decoration-none" href="{{route('items.edit', $item)}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <span style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteItemModal">
                                <i class="fas fa-trash text-danger"></i>
                            </span>
                            <div class="modal fade" id="deleteItemModal" tabindex="-1"
                                 aria-labelledby="deleteItemModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{route('items.destroy', $item)}}" method="post">
                                            @method("DELETE")
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteItemModalLabel">Etes vous sur de
                                                    vouloir supprimer cet item ?</h5>
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
                @if(!$items->count())
                    <tr>
                        <td colspan="7">
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
            {!! $items->links() !!}
        </div>
    </div>
@endsection
