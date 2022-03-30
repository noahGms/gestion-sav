<nav class="d-block d-sm-block d-md-block d-lg-none navbar navbar-expand-lg navbar-dark bg-primary bg-gradient shadow-sm mb-4">
    <div class="container-fluid">
        <a href="/" class="navbar-brand text-logo">Gestion-SAV</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  justify-content-lg-end" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('home.index') ? 'active' : ''}}" aria-current="page" href="{{route('home.index')}}">
                        <i class="fas fa-home"></i> Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('items.index') ? 'active' : ''}}" aria-current="page" href="{{route('items.index')}}">
                        <i class="fas fa-toolbox"></i> Items
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('customers.index') ? 'active' : ''}}" aria-current="page" href="{{route('customers.index')}}">
                        <i class="fas fa-users"></i> Clients
                    </a>
                </li>
                @if(auth()->user()->is_admin)
                <li class="nav-item dropdown">
                    <a class="nav-link {{str_contains(request()->fullUrl(), '/settings') ? 'active' : ''}} dropdown-toggle"
                       href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-cog"></i> Paramètres
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item {{request()->routeIs('users.index') ? 'active' : ''}}"
                               href="{{route('users.index')}}">Utilisateurs</a></li>
                        <li><a class="dropdown-item {{request()->routeIs('states.index') ? 'active' : ''}}"
                               href="{{route('states.index')}}">Etats</a></li>
                        <li><a class="dropdown-item {{request()->routeIs('brands.index') ? 'active' : ''}}"
                               href="{{route('brands.index')}}">Marques</a></li>
                        <li><a class="dropdown-item {{request()->routeIs('categories.index') ? 'active' : ''}}"
                               href="{{route('categories.index')}}">Catégories</a></li>
                        <li><a class="dropdown-item {{request()->routeIs('types.index') ? 'active' : ''}}"
                               href="{{route('types.index')}}">Types</a></li>
                        <li><a class="dropdown-item {{request()->routeIs('returns.index') ? 'active' : ''}}"
                               href="{{route('returns.index')}}">Retours</a></li>
                        <li><a class="dropdown-item {{request()->routeIs('interventions.index') ? 'active' : ''}}"
                               href="{{route('interventions.index')}}">Interventions</a></li>
                        <li><a class="dropdown-item {{request()->routeIs('depots.index') ? 'active' : ''}}"
                               href="{{route('depots.index')}}">Depots</a></li>
                    </ul>
                </li>
                @endif
                <li class="nav-item dropdown">
                    <a style="text-decoration: none; cursor: pointer;" class="nav-link dropdown-toggle"
                       id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i> {{auth()->user()->fullname ? auth()->user()->fullname : 'Mon compte'}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu2">
                        <li>
                            <a class="dropdown-item {{request()->routeIs('profile.index') ? 'active' : ''}}"
                               href="{{route('profile.index')}}">Mon compte</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a href="{{route('logout')}}" class="dropdown-item" type="button">Se déconnecter</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>
