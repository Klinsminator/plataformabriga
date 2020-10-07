<!-- NAVBAR -->
<nav class="navbar navbar-expand-xl bg-primary navbar-dark margin-bottom-30">
    <a class="navbar-brand" href="#">Inicio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Abrigados</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Recursos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('professionals') }}"> Profesionales y Areas</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('symptoms') }}">Síntomas y Recomendaciones</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users') }}">Usuarios</a>
            </li>
        </ul>
        <!--<form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>-->
    </div>
</nav>
<!-- NAVBAR -->
