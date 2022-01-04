@extends("layouts.base")

@section("content")
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <p class="fs-4 mb-0">Liste des clients</p>
                <form class="ms-md-3" action="{{route('customers.index')}}" method="get">
                    <input id="search" name="search" type="text" class="form-control" placeholder="Rechercher un client ...">
                </form>
            </div>
            <a href="{{route('customers.create')}}" class="btn btn-primary btn-md rounded-pill">
                <i class="fas fa-plus"></i> Ajouter un client
            </a>
        </div>
        <div class="table-responsive">
            <table class="table mt-4">
                <thead>
                <tr class="table-dark">
                    <th scope="col">Nom complet</th>
                    <th class="text-center" scope="col">Adresse email</th>
                    <th class="text-center" scope="col">Téléphone fixe</th>
                    <th class="text-center" scope="col">Téléphone portable 1</th>
                    <th class="text-center" scope="col">Téléphone portable 2</th>
                    <th class="text-center" scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{$customer->fullname}}</td>
                        <td class="text-center">{{$customer->email}}</td>
                        <td class="text-center">{{$customer->phone}}</td>
                        <td class="text-center">{{$customer->mobile1}}</td>
                        <td class="text-center">{{$customer->mobile2}}</td>
                        <td class="text-center">
                            <a class="text-decoration-none" href="{{route('customers.show', $customer)}}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="text-decoration-none" href="{{route('customers.edit', $customer)}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <span style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteCustomerModal">
                                <i class="fas fa-trash text-danger"></i>
                            </span>
                            <div class="modal fade" id="deleteCustomerModal" tabindex="-1"
                                 aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{route('customers.destroy', $customer)}}" method="post">
                                            @method("DELETE")
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteCustomerModalLabel">Etes vous sur de
                                                    vouloir supprimer ce client ?</h5>
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
                @if(!$customers->count())
                    <tr>
                        <td colspan="6">
                            <div class="alert alert-primary mt-3" role="alert">
                                Aucune client trouvé
                            </div>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $customers->links() !!}
        </div>
    </div>
@endsection
