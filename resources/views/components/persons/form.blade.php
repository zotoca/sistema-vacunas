<section class="container mt-5">
    <div class="row">
        <div class="col-md-12 col-lg-4 mb-1">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 mb-1 px-lg-1">
                    <div class="dropdown">
                        <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="persons-filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filtrar
                            <i class="fa fa-filter ml-1"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="persons-filter">
                            <a class="dropdown-item" href="#">Lote</a>
                            <a class="dropdown-item" href="#">Nombre</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 px-lg-1">
                    <a href="/persons/create" class="btn btn-success btn-block">Crear persona <i class="fa fa-plus ml-1"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8 text-center">
            <form class="form-inline text-center mx-auto">
                <div class="input-group w-100">
                    <input type="text" name="dni" placeholder="Cedula" class="form-control" />
                    <div class="input-group-append">
                        <button class="btn btn-primary">Buscar <i class="fa fa-search ml-1"></i></button>
                    </div>
                </div>
                <div class="input-group w-100 mt-2">
                    <select name="missing-vaccination" placeholder="Vacuna faltante" class="form-control">
                        @foreach($vaccinations as $vaccination)
                            <option value="{{$vaccination->id}}">{{$vaccination->name}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>
</section>
