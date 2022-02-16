<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gestion-SAV</title>

    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/4f3834f0ec.js" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
<main>
    @auth()
        <div class="d-none d-sm-none d-md-none d-lg-flex flex-column flex-shrink-0 p-3 bg-dark text-white sidebar"
             style="width: 280px; height: 100vh;">
            <a href="/"
               class="d-flex justify-content-center align-items-center md-0 w-100 text-white text-decoration-none">
                <span class="fs-4">Gestion-SAV</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link text-white {{request()->routeIs('items.index') ? 'active' : ''}}"
                       aria-current="page" href="{{route('items.index')}}">
                        <i class="fas fa-toolbox me-1"></i> Items
                    </a>
                </li>
                <li>
                    <a class="nav-link text-white {{request()->routeIs('customers.index') ? 'active' : ''}}"
                       aria-current="page" href="{{route('customers.index')}}">
                        <i class="fas fa-users me-1"></i> Clients
                    </a>
                </li>
                @if(auth()->user()->is_admin)
                    <li class="mb-1">
                        <button
                            class="nav-link btn d-flex justify-content-start align-items-center rounded collapsed w-100 text-white"
                            data-bs-toggle="collapse" data-bs-target="#settings-collapse" aria-expanded="false">
                            <i class="fa fa-chevron-down me-1"></i> Paramètres
                        </button>
                        <div class="collapse" id="settings-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li>
                                    <a class="text-white rounded w-100 {{request()->routeIs('users.index') ? 'active' : ''}} collapse-link"
                                       href="{{route('users.index')}}">Utilisateurs</a>
                                </li>
                                <li>
                                    <a class="text-white rounded w-100 {{request()->routeIs('states.index') ? 'active' : ''}} collapse-link"
                                       href="{{route('states.index')}}">Etats</a>
                                </li>
                                <li>
                                    <a class="text-white rounded w-100 {{request()->routeIs('brands.index') ? 'active' : ''}} collapse-link"
                                       href="{{route('brands.index')}}">Marques</a>
                                </li>
                                <li>
                                    <a class="text-white rounded w-100 {{request()->routeIs('categories.index') ? 'active' : ''}} collapse-link"
                                       href="{{route('categories.index')}}">Catégories</a>
                                </li>
                                <li>
                                    <a class="text-white rounded w-100 {{request()->routeIs('types.index') ? 'active' : ''}} collapse-link"
                                       href="{{route('types.index')}}">Types</a>
                                </li>
                                <li>
                                    <a class="text-white rounded w-100 {{request()->routeIs('returns.index') ? 'active' : ''}} collapse-link"
                                       href="{{route('returns.index')}}">Retours</a>
                                </li>
                                <li>
                                    <a class="text-white rounded w-100 {{request()->routeIs('interventions.index') ? 'active' : ''}} collapse-link"
                                       href="{{route('interventions.index')}}">Interventions</a>
                                </li>
                                <li>
                                    <a class="text-white rounded w-100 {{request()->routeIs('depots.index') ? 'active' : ''}} collapse-link"
                                       href="{{route('depots.index')}}">Depots</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                   id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <img
                        src="https://eu.ui-avatars.com/api/?name={{auth()->user()->fullname ? auth()->user()->firstname . '+' . auth()->user()->lastname : 'Mon+compte'}}"
                        alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>{{auth()->user()->fullname ? auth()->user()->fullname : 'Mon compte'}}</strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                    <li>
                        <a class="dropdown-item {{request()->routeIs('profile.index') ? 'active' : ''}}"
                           href="{{route('profile.index')}}">Mon compte</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a href="{{route('logout')}}" class="dropdown-item" type="button">Se déconnecter</a></li>
                </ul>
            </div>
        </div>


        @include("layouts.header")
    @endauth

    <div class="container content mt-3">
        @yield("content")

        @include("layouts.notification")
        @auth()
            @include("layouts.footer")
        @endauth
    </div>
</main>

<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
