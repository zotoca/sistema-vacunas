<section class="container mt-5" data-aos="fade-up">
    <div class="row">
        @if(auth()->user())
            <div class="col-md-12 col-lg-4 mb-1">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 px-lg-1">
                        <a href="/noticias/crear" class="btn btn-success btn-block">Crear noticia <i class="fa fa-plus ml-1"></i></a>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-12 col-lg-8 text-center">
            <form class="form-inline text-center mx-auto">
                <div class="input-group w-100">
                    <input type="text" name="title" placeholder="Titulo" class="form-control" />
                    <div class="input-group-append">
                        <button class="btn btn-primary">Buscar <i class="fa fa-search ml-1"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
