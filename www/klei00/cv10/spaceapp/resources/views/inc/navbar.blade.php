<nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'NeoNASA') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <a class="nav-item nav-link {{ Request::is('galaxies*') ? 'active' : '' }}" href="/~klei00/cv10/galaxies">Galaxies</a>
                    <a class="nav-item nav-link {{ Request::is('stations') ? 'active' : '' }}" href="/~klei00/cv10/stations">Stations</a>
                </ul>
            </div>
        </div>
    </nav>