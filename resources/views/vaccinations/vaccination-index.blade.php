@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Vacunas")
@section("body")
    @include("components.navbar.navbar-auth")
    <section class="container mt-5">
        <div class="d-flex align-items-center">
            <a href="/panel" class="btn btn-primary mr-3"><i class="fa fa-arrow-left"></i></a>
            <h2>Vacunas</h2>
        </div>
    </section>
    <section class="container mt-5">
        <div class="row">
            <div class="row col-6 col-lg-4 justify-content-between">
                
                <button class="col-12 col-lg-6 btn btn-primary">Filtrar <i class="fa fa-filter"></i></button>
                <button class="col-12 col-lg-6 btn btn-success">Crear vacuna <i class="fa fa-plus"></i></button>
            </div>
            <div class="col-6 col-lg-4 offset-lg-4 text-center">
            
                <form class="form-inline text-center mx-auto">
                    <div class="input-group">
                        <input type="text" name="name" placeholder="Nombre" class="form-control">
                    </div> 
                    <div class="input-group">
                        <button class="btn btn-primary">Buscar <i class="fa fa-search"></i></button>
                    </div>
                </form>
            
            </div>
        </div>
    </section>



    <section class="container mt-5">
        <div class="row">
        @forelse($vaccinations as $vaccination)
        <div class="col-lg-4 col-12 px-2 py-2">
            <div class="card">
                <img class="card-img-top" src="{{asset("/images/vacunas.png")}}" alt="Vacuna">
                <div class="card-body">
                    <h5 class="card-title">{{$vaccination->name}}</h5>
                    <div class="d-flex justify-content-between">
                        <!-- Nota importante, la funcion $vaccination->path() retorna la url de la vacuna "/vacunas/1" por ejemplo, utilizar ese link para realizar
                        las peticiones con axios, ya que en un futuro, quien sabe, el link puede cambiar, y esta funcion viene definida en los modelos,
                        solo si lo deseas, puedes utilizar este link, si no, puedes utilizar $vaccination->id que te dara la id y acto seguido
                        armar la url de la vacuna "/vacunas/1" -->
                        <button class="btn btn-primary" data-delete-vaccination-link="{{$vaccination->path()}}">Editar <i class="fa fa-pencil"></i></a></button>
                        <button class="btn btn-danger" data-edit-vaccinate-link="{{$vaccination->path()}}">Eliminar <i class="fa fa-trash-alt"></i></a></button>
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

@endsection