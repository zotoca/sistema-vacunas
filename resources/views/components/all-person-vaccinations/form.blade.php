<section class="container mt-5" data-aos="fade-up">
    <div class="row">
        <div class="col-md-12 col-lg-8 text-center">
            <form class="form-inline text-center mx-auto">
                <div class="input-group w-100">

                    <select name="vaccination-id" class="form-control">
                        <option value="" selected disabled>Selecciona tu vacuna</option>
                        @foreach ($vaccinations as $vaccination)
                            <option value="{{ $vaccination->id }}">{{ $vaccination->name }}</option>
                        @endforeach
                    </select>
                    
                    <input type="text" name="lot-number" placeholder="Numero de lote" class="form-control" />
                    <input type="text" name="dose" placeholder="Dosis" class="form-control" />
                    <input type="text" name="days" placeholder="Días" class="form-control" />

                    <div class="input-group w-100 mt-2">
                        <input type="date" name="vaccination-date" placeholder="Fecha de vacunacion"
                            class="form-control" />
                    </div>
                    <div class="input-group w-100 mt-2">
                        <select name="is-vaccinated" class="form-control">
                            <option value="" selected>Selecciona el estado de la vacuna</option>
                            <option value="1">Vacunado</option>
                            <option value="0">No vacunado</option>
                        </select>
                    </div>
                </div>



                <div class="row w-100 mt-2">
                    <div class="col-12">
                        <button class="btn btn-primary btn-block">
                            Buscar <i class="fa fa-search ml-1"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
