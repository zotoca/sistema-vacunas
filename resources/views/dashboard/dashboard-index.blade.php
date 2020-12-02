@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Panel")
@section("body")
    @include("components.navbar.navbar-auth")
    <section class="container mt-5">
        <div class="row align-items-center">
            <img src="{{ asset("images/lading_page.png")}}" class="col-6">
            <div class="col-6">
                <p class="lead">
                    Bienvenido al sistema, selecciona que deseas hacer hoy en las siguientes opciones.
                </p>
            </div>
        </div>
    </section>
    <section class="container mt-5">
        <div class="row justify-content-center">
            <div class="card col-6 col-lg-3">
                <div class="card-body">
                    <h3 class="text-center word-break">{{$number_administrators}} Administradores</h3>
                </div>
            </div>
            <div class="card col-6 col-lg-3">
                <div class="card-body">
                    <h3 class="text-center">{{$number_persons}} Personas</h3>
                </div>
            </div>
            <div class="card col-6 col-lg-3">
                <div class="card-body">
                    <h3 class="text-center">{{$number_houses}} Casas</h3>
                </div>
            </div>
            <div class="card col-6 col-lg-3">
                <div class="card-body">
                    <h3 class="text-center">{{$number_streets}} Calles</h3>
                </div>
            </div>
        </div>
    </section>
    <section class="container mt-5">
        <div class="row">
            <div class="col-12 col-lg-6 mt-3 px-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{asset("images/lading_page.png")}}">
                    <div class="card-body">
                        <h3 class="card-title">Vacunas</h3>
                        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi neque reiciendis sequi atque soluta, laudantium nostrum laborum consequatur distinctio p</p>
                        <a href="#" class="btn btn-primary stretched-link">Seleccionar</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-3 px-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{asset("images/lading_page.png")}}">
                    <div class="card-body">
                        <h3 class="card-title">Personas</h3>
                        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi neque reiciendis sequi atque soluta, laudantium nostrum laborum consequatur distinctio p</p>
                        <a href="#" class="btn btn-primary stretched-link">Seleccionar</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-3 px-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{asset("images/lading_page.png")}}">
                    <div class="card-body">
                        <h3 class="card-title">Administradores</h3>
                        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi neque reiciendis sequi atque soluta, laudantium nostrum laborum consequatur distinctio p</p>
                        <a href="#" class="btn btn-primary stretched-link">Seleccionar</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-3 px-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{asset("images/lading_page.png")}}">
                    <div class="card-body">
                        <h3 class="card-title">Calles</h3>
                        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi neque reiciendis sequi atque soluta, laudantium nostrum laborum consequatur distinctio p</p>
                        <a href="#" class="btn btn-primary stretched-link">Seleccionar</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-3 px-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{asset("images/lading_page.png")}}">
                    <div class="card-body">
                        <h3 class="card-title">Foro</h3>
                        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi neque reiciendis sequi atque soluta, laudantium nostrum laborum consequatur distinctio p</p>
                        <a href="#" class="btn btn-primary stretched-link">Seleccionar</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-3 px-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{asset("images/lading_page.png")}}">
                    <div class="card-body">
                        <h3 class="card-title">Noticias</h3>
                        <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi neque reiciendis sequi atque soluta, laudantium nostrum laborum consequatur distinctio p</p>
                        <a href="#" class="btn btn-primary stretched-link">Seleccionar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection