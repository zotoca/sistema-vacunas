<section class="container mt-5" data-aos="fade-up">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <form class="form-inline mx-auto">

                <div class="row m-0 p-0 w-100">
                    <div class="col-sm-12 col-md-6 col-lg-6 pl-0 pr-1">
                        <select name="vaccination-id" class="form-control d-block w-100">
                            <option value="" selected disabled>Selecciona tu vacuna</option>
                            @foreach ($vaccinations as $vaccination)
                                <option value="{{ $vaccination->id }}">{{ $vaccination->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 pr-0">
                        <input type="text" name="lot-number" placeholder="Numero de lote"
                            class="form-control d-block w-100" />
                    </div>
                </div>




                <div class="row m-0 p-0 w-100 mt-1">
                    
                    <div class="col-sm-12 col-md-4 col-lg-4 p-0">
                        <label for="dni" class="d-block w-100">Cedula: </label>
                        <input type="text" name="dni" placeholder="Cedula" class="form-control d-block w-100" />
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 p-0 px-1">
                        <label for="after-dose" class="d-block w-100">Dosís </label>
                        <select class="form-control d-block w-100" name="dose" id="person-vaccination-dose"
                            placeholder="Dosis">
                            <option value="">Selecciona una opcion</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 p-0">
                        <label for="date" class="d-block w-100">Fecha </label>
                        <input type="date" name="vaccination-date" placeholder="Fecha de vacunacion" id="date"
                            class="form-control d-block w-100" />
                    </div>
                </div>

                <div class="row w-100 p-0 m-0 mt-2">
                    <div class="col-sm-12 col-md-6 col-lg-6 p-0 pr-1">
                        <select name="is-vaccinated" class="form-control d-block w-100">
                            <option value="" selected>Selecciona el estado de la vacuna</option>
                            <option value="1">Vacunado</option>
                            <option value="0">No vacunado</option>
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 p-0">
                        <button class="btn btn-primary btn-block">
                            Buscar <i class="fa fa-search ml-1"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
