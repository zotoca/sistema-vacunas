<section class="container mt-5" data-aos="fade-up">
    <div class="row">
        <div class="col-md-12 col-lg-4 mb-1">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 mb-1 px-lg-1">
                    <div class="dropdown">
                        <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="person-vaccination-filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filtrar
                            <i class="fa fa-filter ml-1"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="houses-filter">
                            <a class="dropdown-item" href="#">Lote</a>
                            <a class="dropdown-item" href="#">Nombre</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 px-lg-1">
                    <button class="btn btn-success btn-block" id="create-person-vaccination">Crear vacuna <i class="fa fa-plus ml-1"></i></button>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8 text-center">
            <form class="form-inline text-center mx-auto">
                <div class="input-group w-100">
                    
                    <select name="vaccination-id" class="form-control">
                        <option value="" selected disabled>Selecciona tu vacuna</option>
                        @foreach($vaccinations as $vaccination)
                            <option value="{{$vaccination->id}}">{{$vaccination->name}}</option>
                        @endforeach
                    </select>
                    <input type="text" name="lot-number" placeholder="Numero de lote" class="form-control"/>
                    <input type="text" name="dose" placeholder="Dosis" class="form-control"/>
                    <input type="date" name="vaccination-date" placeholder="Fecha de vacunacion" class="form-control"/>
                    
                    
                </div>
                <div class="row w-100 mt-2">
                    <div class="col-2">
                        <label class="form-check-label">
                            ¿Puestas?
                             <input type="checkbox" name="is-vaccinated" class="form-check-input ml-1" value="true"/>
                        </label>
                    </div>
               
                    <div class="col-10 px-0">
                        <button class="btn btn-primary btn-block">
                            Buscar <i class="fa fa-search ml-1"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
