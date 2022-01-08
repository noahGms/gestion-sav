@extends("layouts.base")

@section("content")
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <p class="fs-4 mb-0">
                <a class="text-dark text-decoration-none" href="{{route('items.index')}}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <span>Ajouter un item</span>
            </p>
        </div>

        <form class="mt-4" action="{{route('items.store')}}" method="post" enctype="multipart/form-data">
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
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users"
                            type="button" role="tab" aria-controls="users" aria-selected="false">Techniciens
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents"
                            type="button" role="tab" aria-controls="documents" aria-selected="false">Documents
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="parts-tab" data-bs-toggle="tab" data-bs-target="#parts"
                            type="button" role="tab" aria-controls="parts" aria-selected="false">Pièces
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="customer" role="tabpanel" aria-labelledby="customer-tab">
                    <div id="customerButton" class="d-flex mt-4 mb-3">
                        <button type="button" onclick="selectCustomer()" class="btn btn-light me-3">Ajouter un client existant</button>
                        <button type="button" onclick="createCustomer()" class="btn btn-light">Créer un nouveau client</button>
                    </div>
                    <div id="selectCustomer" style="display: none;">
                        <div class="row mt-4 mb-3">
                            <div class="mb-3">
                                <label for="customer_id" class="form-label">Client</label>
                                <select class="form-select" id="customer_id" name="customer_id" aria-label="Selectionner un client">
                                    <option value="" selected>Selectionner un client</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->fullname}} - {{optional($customer->address)->full_address}}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                <div class="invalid-feedback">
                                    {{ $errors->first('customer_id') }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div id="newCustomerForm" style="display: none;">
                        <div class="row mt-4 mb-3">
                            <div class="col">
                                <label for="lastname" class="form-label">Nom</label>
                                <input class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                       id="lastname"
                                       type="text" value="{{old('lastname')}}"/>
                                @error('lastname')
                                <div class="invalid-feedback">
                                    {{ $errors->first('lastname') }}
                                </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="firstname" class="form-label">Prénom</label>
                                <input class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                       id="firstname"
                                       type="text" value="{{old('firstname')}}"/>
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
                                   id="email"
                                   value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Téléphone fixe</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                   id="phone"
                                   value="{{ old('phone') }}">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="mobile1" class="form-label">Téléphone portable 1</label>
                            <input type="text" name="mobile1" class="form-control @error('mobile1') is-invalid @enderror"
                                   id="mobile1"
                                   value="{{ old('mobile1') }}">
                            @error('mobile1')
                            <div class="invalid-feedback">
                                {{ $errors->first('mobile1') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="mobile2" class="form-label">Téléphone portable 2</label>
                            <input type="text" name="mobile2" class="form-control @error('mobile2') is-invalid @enderror"
                                   id="mobile2"
                                   value="{{ old('mobile2') }}">
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
                                       name="street_number"
                                       id="street_number"
                                       type="text" value="{{old('street_number')}}"/>
                                @error('street_number')
                                <div class="invalid-feedback">
                                    {{ $errors->first('street_number') }}
                                </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="street_name" class="form-label">Nom de la rue</label>
                                <input class="form-control @error('street_name') is-invalid @enderror" name="street_name"
                                       id="street_name"
                                       type="text" value="{{old('street_name')}}"/>
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
                                       id="zip_code"
                                       type="text" value="{{old('zip_code')}}"/>
                                @error('zip_code')
                                <div class="invalid-feedback">
                                    {{ $errors->first('zip_code') }}
                                </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="city" class="form-label">Ville</label>
                                <input class="form-control @error('city') is-invalid @enderror" name="city"
                                       id="city"
                                       type="text" value="{{old('city')}}"/>
                                @error('city')
                                <div class="invalid-feedback">
                                    {{ $errors->first('city') }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="creation" role="tabpanel" aria-labelledby="creation-tab">
                    <div class="row mt-4 mb-3">
                        <div class="mb-3">
                            <label for="state_id" class="form-label">Etat</label>
                            <select class="form-select" id="state_id" name="state_id" aria-label="Selectionner un état">
                                <option value="" selected>Selectionner un état</option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
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
                            <textarea class="form-control" id="comment_state" name="comment_state" rows="3">{{old('comment_state')}}</textarea>
                            @error('comment_state')
                            <div class="invalid-feedback">
                                {{ $errors->first('comment_state') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="intervention_date" class="form-label">Date de l'intervention</label>
                            <input type="date" class="form-control" id="intervention_date" placeholder="Date de l'intervention" name="intervention_date" value="{{old('intervention_date')}}">
                            @error('intervention_date')
                            <div class="invalid-feedback">
                                {{ $errors->first('intervention_date') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="intervention_id" class="form-label">Moyen d'intervention</label>
                            <select class="form-select" id="intervention_id" name="intervention_id" aria-label="Selectionner un moyen d'intervention">
                                <option value="" selected>Selectionner un moyen d'intervention</option>
                                @foreach($interventions as $intervention)
                                    <option value="{{$intervention->id}}">{{$intervention->name}}</option>
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
                            <select class="form-select" id="depot_id" name="depot_id" aria-label="Selectionner un moyen de dépot">
                                <option value="" selected>Selectionner un moyen de dépot</option>
                                @foreach($depots as $depot)
                                    <option value="{{$depot->id}}">{{$depot->name}}</option>
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
                            <input type="date" class="form-control" id="return_date" placeholder="Date de retour" name="return_date" value="{{old('return_date')}}">
                            @error('return_date')
                            <div class="invalid-feedback">
                                {{ $errors->first('return_date') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="return_id" class="form-label">Moyen de retour</label>
                            <select class="form-select" id="return_id" name="return_id" aria-label="Selectionner un moyen de retour">
                                <option value="" selected>Selectionner un moyen de retour</option>
                                @foreach($returns as $returnMdl)
                                    <option value="{{$returnMdl->id}}">{{$returnMdl->name}}</option>
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
                                <option value="" selected>Selectionner un type</option>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
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
                            <select class="form-select" id="brand_id" name="brand_id" aria-label="Selectionner une marque">
                                <option value="" selected>Selectionner une marque</option>
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
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
                            <input type="text" class="form-control" id="model" placeholder="Modèle" name="model" value="{{old("model")}}">
                            @error('model')
                            <div class="invalid-feedback">
                                {{ $errors->first('model') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="serial_number" class="form-label">Numéro de série</label>
                            <input type="text" class="form-control" id="serial_number" placeholder="Numéro de série" name="serial_number" value="{{old("serial_number")}}">
                            @error('serial_number')
                            <div class="invalid-feedback">
                                {{ $errors->first('serial_number') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="defaults" class="form-label">Défaut signalé</label>
                            <textarea class="form-control" id="defaults" name="defaults" rows="3">{{old('defaults')}}</textarea>
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
                            <textarea class="form-control" id="observations" name="observations" rows="3">{{old('communications')}}</textarea>
                            @error('observations')
                            <div class="invalid-feedback">
                                {{ $errors->first('observations') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="reparations" class="form-label">Réparations</label>
                            <textarea class="form-control" id="reparations" name="reparations" rows="3">{{old('reparations')}}</textarea>
                            @error('reparations')
                            <div class="invalid-feedback">
                                {{ $errors->first('reparations') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="comments" class="form-label">Commentaires</label>
                            <textarea class="form-control" id="comments" name="comments" rows="3">{{old('comments')}}</textarea>
                            @error('comments')
                            <div class="invalid-feedback">
                                {{ $errors->first('comments') }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="communications" class="form-label">Communications</label>
                            <textarea class="form-control" id="communications" name="communications" rows="3">{{old('communications')}}</textarea>
                            @error('communications')
                            <div class="invalid-feedback">
                                {{ $errors->first('communications') }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mb-5" id="users" role="tabpanel" aria-labelledby="users-tab">
                    <div class="mb-3 w-100 mt-4">
                        <label for="users-0" class="form-label">Techniciens</label>
                        <select class="form-select" id="users-0" id="users-${techId}" name="users[]" aria-label="Selectionner un technicien">
                            <option value="" selected>Selectionner un technicien</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->fullname}}</option>
                            @endforeach
                        </select>
                        @error('users')
                            <div class="invalid-feedback">
                                {{ $errors->first('users') }}
                            </div>
                        @enderror
                    </div>
                    <div id="users-wrapper" class="row mb-3"></div>
                    <button class="btn btn-dark btn-sm" onclick="addTech()" type="button" id="users-button">Ajouter un tech</button>
                </div>
                <div class="tab-pane fade mb-5" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                    <div class="mb-3 w-100 mt-4">
                        <label for="files" class="form-label">Documents</label>
                        <input onchange="filesPreview(event)" class="form-control" type="file" id="files" name="files[]" multiple>
                    </div>
                    <div id="files-preview"></div>
                </div>
                <div class="tab-pane fade mb-5" id="parts" role="tabpanel" aria-labelledby="parts-tab">
                    <div class="mb-3 w-100 mt-4">
                        <label for="files" class="form-label">Pièces</label>

                        <div id="parts-alert" class="row mb-3">
                            <div class="alert alert-primary" role="alert">
                                Aucune pièce a été ajouté
                            </div>
                        </div>
                        <div id="parts-wrapper"></div>
                        <button class="btn btn-dark btn-sm" onclick="addPart()" type="button" id="parts-button">Ajouter une pièce</button>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <script>
        let techId = 0
        let techInputId = 0
        let maxSize = {{$users->count()}};
        let partsCount = 0
        let partsInputId = 0

        function addTech() {
            const wrapper = document.getElementById('users-wrapper')
            const button = document.getElementById('users-button')

            techId++
            techInputId++
            if (techId === (maxSize - 1)) {
                button.toggleAttribute('disabled', true)
            }
            wrapper.insertAdjacentHTML("beforeend", `
                <div id="users-div-${techInputId}" class="d-flex align-items-center mb-3">
                    <div class="w-100">
                        <select class="form-select" id="users-${techInputId}" name="users[]" aria-label="Selectionner un technicien">
                            <option value="" selected>Selectionner un technicien</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->fullname}}</option>
                            @endforeach
                        </select>
                        @error('users')
                            <div class="invalid-feedback">
                                {{ $errors->first('users') }}
                            </div>
                        @enderror
                    </div>
                    <div class="ms-4 mt-4">
                        <span style="cursor: pointer;" onclick="deleteTech(${techInputId})">
                            <i class="fas fa-times text-danger"></i>
                        </span>
                    </div>
                </div>
            `)
        }

        function deleteTech(id) {
            const div = document.getElementById(`users-div-${id}`)
            const button = document.getElementById('users-button')

            div.remove()

            techId--
            if (techId < maxSize) {
                button.toggleAttribute('disabled', false)
            }
        }

        function addPart() {
            const wrapper = document.getElementById('parts-wrapper')
            const alert = document.getElementById('parts-alert')

            partsCount++
            if (partsCount > 0) {
                alert.style.display = 'none'
            }
            partsInputId++
            wrapper.insertAdjacentHTML("beforeend", `
                <div id="parts-${partsInputId}" class="row mb-3">
                    <div class="col">
                        <input class="form-control" name="parts[${partsInputId}][name]"
                               id="name"
                               type="text" placeholder="Nom"/>
                    </div>
                    <div class="col">
                        <input class="form-control" name="parts[${partsInputId}][price]"
                               id="price"
                               type="text" placeholder="Prix"/>
                    </div>
                    <div class="col">
                        <input class="form-control" name="parts[${partsInputId}][link]"
                               id="link"
                               type="text" placeholder="Lien"/>
                    </div>
                    <div class="col-1 d-flex align-items-center">
                        <span style="cursor: pointer;" onclick="deletePart(${partsInputId})">
                            <i class="fas fa-times text-danger"></i>
                        </span>
                    </div>
                </div>
            `)
        }

        function deletePart(id) {
            const div = document.getElementById(`parts-${id}`)
            const alert = document.getElementById('parts-alert')

            div.remove()

            partsCount--
            if (partsCount === 0) {
                alert.style.display = 'block'
            }
        }

        function filesPreview(event) {
            const wrapper = document.getElementById('files-preview')
            let id = 0

            if (wrapper.children.length > 0) {
                wrapper.innerHTML = ''
            }

            Array.from(event.target.files).forEach(function (file) {
                if (file.type === 'image/png') {
                    const reader = new FileReader()
                    reader.onload = function(){
                        id++
                        wrapper.insertAdjacentHTML("beforeend", `
                            <img height="100px" width="100px" id="output-${id}"/>
                        `)
                        const output = document.getElementById(`output-${id}`)
                        output.src = reader.result
                    };
                    reader.readAsDataURL(file)
                }
            })
        }

        function hideCustomerButton() {
            const div = document.getElementById("customerButton")
            div.classList = ""
            div.style.display = "none"
        }

        function selectCustomer() {
            const div = document.getElementById("selectCustomer")
            div.style.display = "block"
            hideCustomerButton()
        }

        function createCustomer() {
            const div = document.getElementById("newCustomerForm")
            div.style.display = "block"
            hideCustomerButton()
        }
    </script>
@endsection
