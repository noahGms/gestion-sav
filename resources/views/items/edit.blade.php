@extends("layouts.base")

@section("content")
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <p class="fs-4 mb-0">
                <a class="text-dark text-decoration-none" href="{{route('items.index')}}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <span>Modifier l'item n°{{$item->id}}</span>
            </p>
        </div>

        <form class="mt-4" action="{{route('items.update', $item)}}" method="post">
            @method("PUT")
            @csrf
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="customer-tab" data-bs-toggle="tab" data-bs-target="#customer"
                            type="button" role="tab" aria-controls="customer" aria-selected="true">Client
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="creation-tab" data-bs-toggle="tab" data-bs-target="#creation"
                            type="button" role="tab" aria-controls="creation" aria-selected="false">Création
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="machine-tab" data-bs-toggle="tab" data-bs-target="#machine"
                            type="button" role="tab" aria-controls="machine" aria-selected="false">Machine
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="informations-tab" data-bs-toggle="tab" data-bs-target="#informations"
                            type="button" role="tab" aria-controls="informations" aria-selected="false">Informations
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="customer" role="tabpanel" aria-labelledby="customer-tab">
                    <div class="row mt-4 mb-3">
                        <div class="col">
                            <label for="lastname" class="form-label">Nom</label>
                            <input class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                   id="lastname" type="text" value="{{old('lastname') ?? $item->customer->lastname}}"/>
                            @error('lastname')
                            <div class="invalid-feedback">
                                {{ $errors->first('lastname') }}
                            </div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="firstname" class="form-label">Prénom</label>
                            <input class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                   id="firstname" type="text" value="{{old('firstname') ?? $item->customer->firstname }}"/>
                            @error('firstname')
                            <div class="invalid-feedback">
                                {{ $errors->first('firstname') }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" value="{{ old('email') ?? $item->customer->email }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Téléphone fixe</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                               id="phone" value="{{ old('phone') ?? $item->customer->phone }}">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile1" class="form-label">Téléphone portable 1</label>
                        <input type="text" name="mobile1" class="form-control @error('mobile1') is-invalid @enderror"
                               id="mobile1" value="{{ old('mobile1') ?? $item->customer->mobile1 }}">
                        @error('mobile1')
                        <div class="invalid-feedback">
                            {{ $errors->first('mobile1') }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile2" class="form-label">Téléphone portable 2</label>
                        <input type="text" name="mobile2" class="form-control @error('mobile2') is-invalid @enderror"
                               id="mobile2" value="{{ old('mobile2') ?? $item->customer->mobile2 }}">
                        @error('mobile2')
                        <div class="invalid-feedback">
                            {{ $errors->first('mobile2') }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="street_number" class="form-label">Numéro de la rue</label>
                            <input class="form-control @error('street_number') is-invalid @enderror"
                                   name="street_number" id="street_number" type="text"
                                   value="{{old('street_number') ?? $item->customer->address->street_number }}"/>
                            @error('street_number')
                            <div class="invalid-feedback">
                                {{ $errors->first('street_number') }}
                            </div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="street_name" class="form-label">Nom de la rue</label>
                            <input class="form-control @error('street_name') is-invalid @enderror" name="street_name"
                                   id="street_name" type="text" value="{{old('street_name') ?? $item->customer->address->street_name}}"/>
                            @error('street_name')
                            <div class="invalid-feedback">
                                {{ $errors->first('street_name') }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="zip_code" class="form-label">Code postal</label>
                            <input class="form-control @error('zip_code') is-invalid @enderror" name="zip_code"
                                   id="zip_code" type="text" value="{{old('zip_code') ?? $item->customer->address->zip_code }}"/>
                            @error('zip_code')
                            <div class="invalid-feedback">
                                {{ $errors->first('zip_code') }}
                            </div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="city" class="form-label">Ville</label>
                            <input class="form-control @error('city') is-invalid @enderror" name="city" id="city"
                                   type="text" value="{{old('city') ?? $item->customer->address->city }}"/>
                            @error('city')
                            <div class="invalid-feedback">
                                {{ $errors->first('city') }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="creation" role="tabpanel" aria-labelledby="creation-tab">
                    <div class="row mt-4 mb-3">
                        <div class="mb-3">
                            <label for="state_id" class="form-label">Etat</label>
                            <select class="form-select" id="state_id" name="state_id" aria-label="Selectionner un état">
                                @if(!$item->state)
                                <option value="" selected>Selectionner un état</option>
                                @endif
                                @foreach($states as $state)
                                    <option @if(optional($item->state)->id === $state->id) selected @endif value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                            @error('state_id')
                            <div class="invalid-feedback">
                                {{ $errors->first('state_id') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="comment_state" class="form-label">Commentaire sur l'état</label>
                            <textarea class="form-control" id="comment_state" name="comment_state" rows="3">{{old('comment_state') ?? $item->comment_state }}</textarea>
                            @error('comment_state')
                            <div class="invalid-feedback">
                                {{ $errors->first('comment_state') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="intervention_date" class="form-label">Date de l'intervention</label>
                            <input type="date" class="form-control" id="intervention_date"
                                   placeholder="Date de l'intervention" name="intervention_date" value="{{old('intervention_date') ?? $item->intervention_date->format('Y-m-d')}}">
                            @error('intervention_date')
                            <div class="invalid-feedback">
                                {{ $errors->first('intervention_date') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="intervention_id" class="form-label">Moyen d'intervention</label>
                            <select class="form-select" id="intervention_id" name="intervention_id"
                                    aria-label="Selectionner un moyen d'intervention">
                                @if(!$item->intervention)
                                <option value="" selected>Selectionner un moyen d'intervention</option>
                                @endif
                                @foreach($interventions as $intervention)
                                    <option @if(optional($item->intervention)->id === $intervention->id) selected @endif value="{{$intervention->id}}">{{$intervention->name}}</option>
                                @endforeach
                            </select>
                            @error('intervention_id')
                            <div class="invalid-feedback">
                                {{ $errors->first('intervention_id') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="depot_id" class="form-label">Moyen de dépot</label>
                            <select class="form-select" id="depot_id" name="depot_id"
                                    aria-label="Selectionner un moyen de dépot">
                                @if(!$item->intervention)
                                <option value="" selected>Selectionner un moyen de dépot</option>
                                @endif
                                @foreach($depots as $depot)
                                    <option @if(optional($item->depot)->id === $depot->id) selected @endif value="{{$depot->id}}">{{$depot->name}}</option>
                                @endforeach
                            </select>
                            @error('depot_id')
                            <div class="invalid-feedback">
                                {{ $errors->first('depot_id') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="return_date" class="form-label">Date de retour</label>
                            <input type="date" class="form-control" id="return_date" placeholder="Date de retour"
                                   name="return_date" value="{{old('return_date') ?? $item->return_date->format('Y-m-d')}}">
                            @error('return_date')
                            <div class="invalid-feedback">
                                {{ $errors->first('return_date') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="return_id" class="form-label">Moyen de retour</label>
                            <select class="form-select" id="return_id" name="return_id"
                                    aria-label="Selectionner un moyen de retour">
                                @if(!$item->returnMdl)
                                <option value="" selected>Selectionner un moyen de retour</option>
                                @endif
                                @foreach($returns as $returnMdl)
                                    <option @if(optional($item->returnMdl)->id === $returnMdl->id) selected @endif value="{{$returnMdl->id}}">{{$returnMdl->name}}</option>
                                @endforeach
                            </select>
                            @error('return_id')
                            <div class="invalid-feedback">
                                {{ $errors->first('return_id') }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="machine" role="tabpanel" aria-labelledby="machine-tab">
                    <div class="row mt-4 mb-3">
                        <div class="mb-3">
                            <label for="type_id" class="form-label">Type</label>
                            <select class="form-select" id="type_id" name="type_id" aria-label="Selectionner un type">
                                @if(!$item->type)
                                <option value="" selected>Selectionner un type</option>
                                @endif
                                @foreach($types as $type)
                                    <option @if(optional($item->type)->id === $type->id) selected @endif value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                            @error('type_id')
                            <div class="invalid-feedback">
                                {{ $errors->first('type_id') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Marque</label>
                            <select class="form-select" id="brand_id" name="brand_id"
                                    aria-label="Selectionner une marque">
                                @if(!$item->brand)
                                <option value="" selected>Selectionner une marque</option>
                                @endif
                                @foreach($brands as $brand)
                                    <option @if(optional($item->brand)->id === $brand->id) selected @endif value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                            <div class="invalid-feedback">
                                {{ $errors->first('brand_id') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="model" class="form-label">Modèle</label>
                            <input type="text" class="form-control" id="model" placeholder="Modèle" name="model" value="{{old('model') ?? $item->model}}">
                            @error('model')
                            <div class="invalid-feedback">
                                {{ $errors->first('model') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="serial_number" class="form-label">Numéro de série</label>
                            <input type="text" class="form-control" id="serial_number" placeholder="Numéro de série"
                                   name="serial_number" value="{{old('serial_number') ?? $item->serial_number}}">
                            @error('serial_number')
                            <div class="invalid-feedback">
                                {{ $errors->first('serial_number') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="defaults" class="form-label">Défaut signalé</label>
                            <textarea class="form-control" id="defaults" name="defaults" rows="3">{{ old('defaults') ?? $item->defaults}}</textarea>
                            @error('defaults')
                            <div class="invalid-feedback">
                                {{ $errors->first('defaults') }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="informations" role="tabpanel" aria-labelledby="informations-tab">
                    <div class="row mt-4 mb-3">
                        <div class="mb-3">
                            <label for="observations" class="form-label">Observations</label>
                            <textarea class="form-control" id="observations" name="observations" rows="3">{{ old('observations') ?? $item->observations}}</textarea>
                            @error('observations')
                            <div class="invalid-feedback">
                                {{ $errors->first('observations') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="reparations" class="form-label">Réparations</label>
                            <textarea class="form-control" id="reparations" name="reparations" rows="3">{{ old('reparations') ?? $item->reparations}}</textarea>
                            @error('reparations')
                            <div class="invalid-feedback">
                                {{ $errors->first('reparations') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="comments" class="form-label">Commentaires</label>
                            <textarea class="form-control" id="comments" name="comments" rows="3">{{ old('comments') ?? $item->comments}}</textarea>
                            @error('comments')
                            <div class="invalid-feedback">
                                {{ $errors->first('comments') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="communications" class="form-label">Communications</label>
                            <textarea class="form-control" id="communications" name="communications"
                                      rows="3">{{ old('communications') ?? $item->communications}}</textarea>
                            @error('communications')
                            <div class="invalid-feedback">
                                {{ $errors->first('communications') }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
@endsection
