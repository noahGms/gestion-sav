@extends("layouts.base")

@section("content")
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                        <div class="align-self-center">
                            <i class="fas fa-toolbox text-dark fa-3x"></i>
                        </div>
                        <div class="text-end">
                            <h3>{{ $items_in_progress }}</h3>
                            <p class="mb-0">Item en cours</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                        <div class="align-self-center">
                            <i class="fas fa-toolbox text-dark fa-3x"></i>
                        </div>
                        <div class="text-end">
                            <h3>{{ $items_archived }}</h3>
                            <p class="mb-0">Item archivés</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                        <div class="align-self-center">
                            <i class="fas fa-toolbox text-dark fa-3x"></i>
                        </div>
                        <div class="text-end">
                            <h3>{{ $total_item }}</h3>
                            <p class="mb-0">Nombre d'items</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                        <div class="align-self-center">
                            <i class="fa fa-users text-dark fa-3x"></i>
                        </div>
                        <div class="text-end">
                            <h3>{{ $total_customer }}</h3>
                            <p class="mb-0">Nombre de clients</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-start align-items-center">
                <div class="fs-3">Items en cours</div>
                <a class="d-flex justify-content-center align-items-center text-decoration-none fs-5" href="{{route('items.index')}}">
                    <i class="fas fa-external-link-alt ms-2"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
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
                                <a class="text-decoration-none" href="{{route('items.show', $item)}}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {!! $items->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
