<section class="container mt-5">
    <div class="row">
        <div class="col-md-12 col-lg-4 mb-1">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 mb-1 px-lg-1">
                    <div class="dropdown">
                        <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="vaccinations-filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filtrar
                            <i class="fa fa-filter ml-1"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="vaccinations-filter">
                            <a class="dropdown-item" href="#">Lote</a>
                            <a class="dropdown-item" href="#">Nombre</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 px-lg-1">
                    <button class="btn btn-success btn-block" id="create-vaccination">Crear vacuna <i class="fa fa-plus ml-1"></i></button>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8 text-center">
            <form class="form-inline text-center mx-auto">
                <div class="input-group w-100">
                    <input type="text" name="name" placeholder="Nombre" class="form-control" required />
                    <div class="input-group-append">
                        <button class="btn btn-primary">Buscar <i class="fa fa-search ml-1"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
