<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
    <div class="container-fluid">
        <a href="/" class="navbar-brand text-logo">Gestion-SAV</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  justify-content-lg-end" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">
                        <i class="fas fa-toolbox"></i> Items
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">
                        <i class="fas fa-users"></i> Clients
                    </a>
                </li>
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
                        <li><a class="dropdown-item" href="#">Types</a></li>
                        <li><a class="dropdown-item" href="#">Retours</a></li>
                        <li><a class="dropdown-item" href="#">Interventions</a></li>
                        <li><a class="dropdown-item" href="#">Dépots</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a style="text-decoration: none; cursor: pointer;" class="nav-link dropdown-toggle"
                       id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i> Mon compte
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu2">
                        <li>
                            <button class="dropdown-item" type="button">Modifier mon compte</button>
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
