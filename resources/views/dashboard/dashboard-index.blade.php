@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Panel")
@section("body")
    @include("components.navbar.navbar-auth")
    <section class="container mt-5" data-aos="fade-up">
        <div class="dashboard-banner">
            <div class="row align-items-center">
                <div class="col-4">
                    <img src="{{ asset("images/welcome.png")}}" class="img-fluid img-dashboard-welcome">
                </div>
                <div class="col-8">
                    <p class="lead title text-white">
                        Bienvenido al sistema, selecciona que deseas hacer hoy en las siguientes opciones.
                    </p>
                </div>
            </div>
        </div>
        
    </section>

    <section class="container mt-5" data-aos="fade-up">
        <h2 class="title title-big title-underline my-5">Resumen</h2>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
                <div class="card card-admins border-0 shadow-element">
                    <div class="card-body text-white">
                        <div class="row">
                            <div class="col-7">
                                <h3 class="word-break title">{{$number_administrators}}</h3>
                            </div>
                            <div class="col-5 text-right">
                                <i class="fa fa-user-shield"></i>
                            </div>
                        </div>
                        <h5 class="title">Administradores</h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
                <div class="card  card-persons border-0 shadow-element">
                    <div class="card-body text-white">
                        <div class="row">
                            <div class="col-7">
                                <h3 class=" word-break title">{{$number_persons}}</h3>
                            </div>
                            <div class="col-5 text-right">
                                <i class="fa fa-user-friends"></i>
                            </div>
                        </div>
                        <h5 class="title">Personas</h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
                <div class="card card-houses border-0 shadow-element">
                    <div class="card-body text-white">
                        <div class="row">
                            <div class="col-7">
                                <h3 class=" word-break title">{{$number_houses}}</h3>
                            </div>
                            <div class="col-5 text-right">
                                <i class="fa fa-home"></i>
                            </div>
                        </div>
                        <h5 class="title">Casas</h5>
                    </div>
                </div>
                
            </div>

            <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
                <div class="card card-streets border-0 shadow-element">
                     <div class="card-body text-white">
                        <div class="row">
                            <div class="col-7">
                                <h3 class=" word-break title">{{$number_streets}}</h3>
                            </div>
                            <div class="col-5 text-right">
                                <i class="fa fa-road"></i>
                            </div>
                        </div>
                        <h5 class="title">Calles</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-5 dashboard-actions" data-aos="fade-up">
        <h2 class="title title-big title-underline my-5">Acciones</h2>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 mb-4 px-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{asset("images/vacunas.png")}}">
                    <div class="card-body">
                        <h3 class="card-title title">Vacunas</h3>
                        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi neque reiciendis sequi atque soluta, laudantium nostrum laborum consequatur distinctio p</p>
                        <a href="#" class="btn btn-block btn-primary stretched-link">Seleccionar</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4 mb-4 px-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{asset("images/persons.png")}}">
                    <div class="card-body">
                        <h3 class="card-title title">Personas</h3>
                        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi neque reiciendis sequi atque soluta, laudantium nostrum laborum consequatur distinctio p</p>
                        <a href="#" class="btn btn-block btn-primary stretched-link">Seleccionar</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4 mb-4 px-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{asset("images/admins.png")}}">
                    <div class="card-body">
                        <h3 class="card-title title">Administradores</h3>
                        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi neque reiciendis sequi atque soluta, laudantium nostrum laborum consequatur distinctio p</p>
                        <a href="#" class="btn btn-block btn-primary stretched-link">Seleccionar</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4 mb-4 px-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{asset("images/streets.png")}}">
                    <div class="card-body">
                        <h3 class="card-title title">Calles</h3>
                        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi neque reiciendis sequi atque soluta, laudantium nostrum laborum consequatur distinctio p</p>
                        <a href="#" class="btn btn-block btn-primary stretched-link">Seleccionar</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4 mb-4 px-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{asset("images/foro.jpg")}}">
                    <div class="card-body">
                        <h3 class="card-title title">Foro</h3>
                        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi neque reiciendis sequi atque soluta, laudantium nostrum laborum consequatur distinctio p</p>
                        <a href="#" class="btn btn-block btn-primary stretched-link">Seleccionar</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4 mb-4 px-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{asset("images/news.jpg")}}">
                    <div class="card-body">
                        <h3 class="card-title title">Noticias</h3>
                        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi neque reiciendis sequi atque soluta, laudantium nostrum laborum consequatur distinctio p</p>
                        <a href="#" class="btn btn-block btn-primary stretched-link">Seleccionar</a>
                    </div>
                </div>
            </div>
        </div>
        @include("components.footer.footer")
    </section>
@endsection