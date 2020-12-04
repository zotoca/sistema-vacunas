@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Vacunas")
@section("body")
    @include("components.navbar.navbar-auth")
    <section class="container mt-5">
        <div class="d-flex align-items-center">
            <a href="/panel" class="btn btn-primary mr-3"><i class="fa fa-arrow-left"></i></a>
            <h2 class="title title-big">Vacunas</h2>
        </div>
    </section>

    <section class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-lg-4 mb-1">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-1 px-lg-1">
                        <div class="dropdown">
                            <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="vaccinations-filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtrar 
                                <i class="fa fa-filter ml-1"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="vaccinations-filter">
                                <a class="dropdown-item" href="#">Lote</a>
                                <a class="dropdown-item" href="#">Nombre</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 px-lg-1">
                        <button class="btn btn-success btn-block" id="create-vaccination">
                            Crear vacuna <i class="fa fa-plus ml-1"></i>
                        </button>
                    </div>
                </div>
                
            </div>
            <div class="col-md-12 col-lg-8 text-center">
                <form class="form-inline text-center mx-auto">
                    <div class="input-group w-100">
                        <input type="text" name="name" placeholder="Nombre" class="form-control " required>
                        <div class="input-group-append">
                            <button class="btn btn-primary">Buscar <i class="fa fa-search ml-1"></i></button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </section>

    <section class="container mt-5">
        <div class="row">
        @forelse($vaccinations as $vaccination)
        <div class="col-sm-12 col-md-6 col-lg-4 px-2 py-2">
            <div class="card">
                <img class="card-img-top" src="{{asset("/images/vacunas.png")}}" alt="{{$vaccination->name}}" title="{{$vaccination->name}}">
                <div class="card-body">
                    <h5 class="card-title title pl-1">{{$vaccination->name}}</h5>
                        <!-- Nota importante, la funcion $vaccination->path() retorna la url de la vacuna "/vacunas/1" por ejemplo, utilizar ese link para realizar
                        las peticiones con axios, ya que en un futuro, quien sabe, el link puede cambiar, y esta funcion viene definida en los modelos,
                        solo si lo deseas, puedes utilizar este link, si no, puedes utilizar $vaccination->id que te dara la id y acto seguido
                        armar la url de la vacuna "/vacunas/1" -->
                        <div class="row w-100 m-0">
                            <div class="col-sm-12 col-lg-6 p-1">
                                <button class="btn btn-primary btn-block" data-id="{{$vaccination->id}}" data-action="edit">
                                    Editar 
                                    <i class="fa fa-pencil ml-1"></i>
                                </button>
                            </div>
                            <div class="col-sm-12 col-lg-6 p-1">
                                <button class="btn btn-danger btn-block" data-id="{{$vaccination->id}}" data-action="delete">
                                    Eliminar 
                                    <i class="fa fa-trash-alt ml-1"></i>
                                </button>
                            </div>
                        </div>
                </div>
            </diV>
        </div>
        @empty
        <h1>Sin vacunas aun</h1>
        @endforelse
        </div>
    </section>

    <section class="container mt-5">
        <div class="d-flex justify-content-center">
            {{$vaccinations->links()}}
        </div>
    </section>

    @include("components.footer.footer")
    <script src={{asset("scripts/js/vaccinations/vaccionations.js")}} type="module"></script>
@endsection