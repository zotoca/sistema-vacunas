@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Calles")
@section("body")
    @include("components.navbar.navbar-auth")
    <section class="container mt-5">
        <div class="d-flex align-items-center">
            <a href="/panel" class="btn btn-primary mr-3"><i class="fa fa-arrow-left"></i></a>
            <h2 class="title title-big">Calles</h2>
        </div>
    </section>

    <section class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-lg-4 mb-1">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 mb-1 px-lg-1">
                        <div class="dropdown">
                            <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="streets-filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtrar 
                                <i class="fa fa-filter ml-1"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="streets-filter">
                                <a class="dropdown-item" href="#">Lote</a>
                                <a class="dropdown-item" href="#">Nombre</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 px-lg-1">
                        <button class="btn btn-success btn-block" id="create-street">
                            Crear calle <i class="fa fa-plus ml-1"></i>
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
        @forelse($streets as $street)
        <div class="col-sm-12 col-md-6 col-lg-4 px-2 py-2">
            <div class="card">
                <img class="card-img-top" src="{{asset("/images/streets.png")}}" alt="{{$street->name}}" title="{{$street->name}}">
                <div class="card-body">
                    <h5 class="card-title title pl-1">{{$street->name}}</h5>
                        <div class="row w-100 m-0">
                            <div class="col-sm-12 col-lg-6 p-1">
                                <button class="btn btn-primary btn-block" data-id="{{$street->id}}" data-action="edit">
                                    Editar 
                                    <i class="fa fa-pencil ml-1"></i>
                                </button>
                            </div>
                            <div class="col-sm-12 col-lg-6 p-1">
                                <button class="btn btn-danger btn-block" data-id="{{$street->id}}" data-action="delete">
                                    Eliminar 
                                    <i class="fa fa-trash-alt ml-1"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row w-100 m-0">
                            <button class="btn btn-primary btn-block" href="/calles/{{$street->id}}/casas">Casas <i class="fa fa-home"></i></button>
                        </div>
                </div>
            </diV>
        </div>
        @empty
        <h1>Sin calles aun</h1>
        @endforelse
        </div>
    </section>

    <section class="container mt-5">
        <div class="d-flex justify-content-center">
            {{$streets->links()}}
        </div>
    </section>

    @include("components.footer.footer")
    <script src={{asset("scripts/js/streets/streets.js")}} type="module"></script>
@endsection