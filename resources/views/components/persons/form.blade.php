<section class="container mt-5" data-aos="fade-up">
    <div class="row">
        <div class="col-md-12 col-lg-4 mb-1">
            <div class="row">
                <div class="col-12">
                    <a href="/personas/crear" class="btn btn-success btn-block">Crear persona <i class="fa fa-plus ml-1"></i></a>
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
                <label for="missing-vaccination">Vacuna faltante:</label>
                <div class="input-group w-100 mt-2">
                    <select name="missing-vaccination" placeholder="Vacuna faltante" class="form-control">
                        <option value="">Selecciona una vacuna</option>
                        @foreach($vaccinations as $vaccination)
                            <option value="{{$vaccination->id}}">{{$vaccination->name}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>
</section>
