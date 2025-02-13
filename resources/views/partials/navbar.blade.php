@if(Session::has('user'))
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Logo o título de la aplicación -->
        <a class="navbar-brand" href="#">
            <img src="{{ Vite::asset('resources/img/logo.png') }}" alt="Logo Empresa" class="logo-navbar">
        </a>

        <!-- Botón para el menú en pantallas pequeñas -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Items del menú -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('aportantes.index') }}">Aportantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('beneficiarios.index') }}">Beneficiarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('muertos.index') }}">Muertos</a>
                </li>

                <!-- Mostrar "Configurar Costos" solo para admin -->
                @if(Session::get('user')->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('costos.index') }}">Configurar Costos</a>
                    </li>
                @endif

                <!-- Menú desplegable para Facturación -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Facturación
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('facturas.index') }}">Facturación de Fallecidos</a></li>
                        <li><a class="dropdown-item" href="{{ route('factura.afiliacion') }}">Factura por Afiliación</a></li>
                        <li><a class="dropdown-item" href="{{ route('factura.historial') }}">Historial de Facturas</a></li>
                    </ul>
                </li>

                <!-- Desembolso de Fallecido -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('desembolsos.index') }}">Desembolso de Fallecido</a>
                </li>

                <!-- Estadísticas -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('estadisticas.index') }}">Estadísticas</a>
                </li>
            </ul>

            <!-- Mostrar nombre del usuario y desplegable de cerrar sesión -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Session::get('user')->username }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endif
