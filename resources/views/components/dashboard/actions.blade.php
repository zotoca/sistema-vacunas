<section class="container mt-5 dashboard-actions" data-aos="fade-up">
    <h2 class="title title-big title-underline my-5">Módulos</h2>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4 mb-4 px-3">
            <div class="card">
                <img class="card-img-top img-fluid" src="{{asset("images/vacunas.png")}}">
                <div class="card-body">
                    <h3 class="card-title title">Vacunas</h3>
                    <p class="card-text">
                        Módulo referente a las vacunas del sector morichal, las cuales
                        serán asignadas a las personas que habitan en la comunidad. 
                        Precaución en la gestión de este módulo.
                    </p>
                    <a href="/vacunas" class="btn btn-block btn-primary stretched-link">Seleccionar</a>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 mb-4 px-3">
            <div class="card">
                <img class="card-img-top img-fluid" src="{{asset("images/persons.png")}}">
                <div class="card-body">
                    <h3 class="card-title title">Personas</h3>
                    <p class="card-text">
                        Módulo referente a las personas que habitan el sector morichal.
                        Este módulo hace uso del módulo de vacunas para administrar las vacunas de las personas.
                    </p>
                    <a href="/personas" class="btn btn-block btn-primary stretched-link">Seleccionar</a>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 mb-4 px-3">
            <div class="card">
                <img class="card-img-top img-fluid" src="{{asset("images/admins.png")}}">
                <div class="card-body">
                    <h3 class="card-title title">Administradores</h3>
                    <p class="card-text">
                        Módulo refente a las personas con roles de administradores del sistema, estás
                        pueden realizar acciones de alto privilegio en los módulos anteriores.
                    </p>
                    <a href="/administradores" class="btn btn-block btn-primary stretched-link">Seleccionar</a>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 mb-4 px-3">
            <div class="card">
                <img class="card-img-top img-fluid" src="{{asset("images/foro.jpg")}}">
                <div class="card-body">
                    <h3 class="card-title title">Foro</h3>
                    <p class="card-text">
                        Módulo referente a dudas, problemas o debates relacionado al sistema/vacunas.
                    </p>
                    <a href="/foro" class="btn btn-block btn-primary stretched-link">Seleccionar</a>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 mb-4 px-3">
            <div class="card">
                <img class="card-img-top img-fluid" src="{{asset("images/news.jpg")}}">
                <div class="card-body">
                    <h3 class="card-title title">Noticias</h3>
                    <p class="card-text">
                        Módulo referente a la gestión de noticias o actividades relacionadas a las vacunas.
                    </p>
                    <a href="/noticias" class="btn btn-block btn-primary stretched-link">Seleccionar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 mb-4 px-3">
            <div class="card">
                <img class="card-img-top img-fluid" src="{{asset("images/vaccinations.jpg")}}">
                <div class="card-body">
                    <h3 class="card-title title">Calendarios de vacunas</h3>
                    <p class="card-text">
                        Modulo para la gestion de todos los calendarios de vacunas
                    </p>
                    <a href="/calendarios-de-vacunas" class="btn btn-block btn-primary stretched-link">Seleccionar</a>
                </div>
            </div>
        </div>
    </div>
</section>
