<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light mt-3">
        <a class="title navbar-brand text-uppercase" href="/">
            <img src="{{asset("images/brand.png")}}" 
                width="32" height="32" alt="Logo del sistema" class="mr-1">
            Navbar
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <div class="navbar-nav mx-auto">
                <a class="nav-item nav-link nav-item-hover text-uppercase" href="http://{{request()->getHttpHost()}}/#mision" data-hash="mision">misión</a>
                <a class="nav-item nav-link nav-item-hover text-uppercase" href="http://{{request()->getHttpHost()}}/#vision" data-hash="vision">visión</a>
                <a class="nav-item nav-link nav-item-hover text-uppercase" href="http://{{request()->getHttpHost()}}/#galeria" data-hash="galeria">galería</a>
                <a class="nav-item nav-link nav-item-hover text-uppercase" href="http://{{request()->getHttpHost()}}/#organigrama" data-hash="organigrama">organigrama</a>
                <a class="nav-item nav-link nav-item-hover text-uppercase" href="/noticias">noticias</a>
                <a class="nav-item nav-link nav-item-hover text-uppercase border rounded" href="/iniciar-sesion">iniciar sesión</a>
            </div>
        </div>
    </nav>
</div>
