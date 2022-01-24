@extends("layouts.base")

@section("content")
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <p class="fs-4 mb-0">
                <a class="text-dark text-decoration-none" href="{{route('customers.index')}}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <span>Client n°{{$customer->id}} - {{$customer->fullname}}</span>
            </p>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card w-100 h-100">
                    <div class="card-body">
                        <h5 class="card-title mb-3" style="font-weight: bold;">Information</h5>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <p class="text-decoration-underline">Nom complet :</p>
                                    <span>{{$customer->fullname}}</span>
                                </div>
                                <div class="mb-3">
                                    <p class="text-decoration-underline">Adresse email :</p>
                                    <span>{{$customer->email}}</span>
                                </div>
                                <div class="mb-3">
                                    <p class="text-decoration-underline">Téléphone fixe :</p>
                                    <span>{{$customer->phone}}</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <p class="text-decoration-underline">Téléphone portable 1 :</p>
                                    <span>{{$customer->mobile1}}</span>
                                </div>
                                <div class="mb-3">
                                    <p class="text-decoration-underline">Téléphone portable 2 :</p>
                                    <span>{{$customer->mobile2}}</span>
                                </div>
                                <div class="mb-3">
                                    <p class="text-decoration-underline">Adresse :</p>
                                    <span>{{optional($customer->address)->full_address}}</span>
                                </div>
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
                            <h5 class="card-title mb-0" style="font-weight: bold;">Items</h5>
                        </div>
                        <div class="row">
                            <div>
                                @if(!$customer->items->count())
                                    <div class="alert alert-primary mb-0" role="alert">
                                        Aucun item
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="table-light">
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th class="text-center" scope="col">Type</th>
                                                <th class="text-center" scope="col">Machine</th>
                                                <th class="text-center" colspan="2" scope="col">Etat</th>
                                                <th class="text-center" scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($customer->items as $item)
                                                <tr>
                                                    <td>{{$item->intervention_date}}</td>
                                                    <td class="text-center">{{optional($item->type)->name}}</td>
                                                    <td class="text-center">{{optional($item->brand)->name}} - {{$item->model}}</td>
                                                    <td class="text-center  text-{{LightOrDarkColor::getTextColor(optional($item->state)->color)}}" style="background: {{optional($item->state)->color}};">{{$item->comment_state}}</td>
                                                    <td class="text-center  text-{{LightOrDarkColor::getTextColor(optional($item->state)->color)}}" style="background: {{optional($item->state)->color}};">{{optional($item->state)->name}}</td>
                                                    <td class="text-center">
                                                        <a class="text-decoration-none" href="{{route('items.show', $item)}}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
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
    </div>
@endsection
