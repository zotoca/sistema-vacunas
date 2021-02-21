<div class="container">
    <nav class="navbar navbar-auth navbar-expand-lg navbar-light mt-3">
        <a class="title navbar-brand text-uppercase" href="/">
            <img src="{{asset("images/brand.png")}}" 
                width="32" height="32" alt="Logo del sistema" class="mr-1">
            SVM
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <div class="navbar-nav mx-auto">
                <a class="nav-item nav-link nav-item-hover text-uppercase" href="/perfil">Ver mi perfil</a>
                <a class="nav-item nav-link nav-item-hover text-uppercase" href="/vacunas">Vacunas</a>
                <a class="nav-item nav-link nav-item-hover text-uppercase" href="/personas">Personas</a>
                <a class="nav-item nav-link nav-item-hover text-uppercase" href="/administradores">Administradores</a>
                <a class="nav-item nav-link nav-item-hover text-uppercase" href="/foro">Foro</a>
                <a class="nav-item nav-link nav-item-hover text-uppercase" href="/noticias">Noticias</a>
                <a class="nav-item nav-link nav-item-hover text-uppercase" href="/logout">Cerrar sesion</a>
                <input type="checkbox" id="dark-mode-toggler" class="d-none">
                <label for="dark-mode-toggler" id="dark-mode" class="nav-item ">
                    <i class="fa fa-moon"></i>
                </label>
            </div>
        </div>
    </nav>
</div>
