<section class="container mt-5" data-aos="fade-up">
    <div class="row">
        @forelse($person_vaccinations as $person_vaccination)
            <div class="col-sm-12 col-md-6 col-lg-4 px-2 py-2">
                <div class="card">

                    <div class="card-body">
                        
                        <h6 class="card-title title pl-1">
                            <span class="ml-1">
                                Nombre y apellido: {{ $person_vaccination->person->first_name }} {{ $person_vaccination->person->last_name }}
                            </span>
                        </h6>
                        
                        <h6 class="card-title title pl-1">
                            <span class="ml-1">
                                Cedula: {{ $person_vaccination->person->dni }}
                            </span>
                        </h6>

                        <h6 class="card-title title pl-1">    
                            <span class="ml-1">
                                Vacuna: {{ $person_vaccination->vaccination->name }}
                            </span>
                        </h6>
                        <hr>
                        <h6 class="card-text pl-1">

                            <span class="font-weight-bold mr-1"> Fecha de vacunacion:</span>
                            {{ $person_vaccination->vaccination_date }}
                        </h6>

                        <h6 class="card-text pl-1">
                            <span class="font-weight-bold mr-1">
                                Dosis: {{ $person_vaccination->dose == '' ? 'No especificada' : $person_vaccination->dose }}
                            </span>
                        </h6>

                        <h6 class="card-text pl-1">
                            <span class="font-weight-bold mr-1">
                                Numero de lote:
                            </span>
                            {{ $person_vaccination->lot_number == '' ? 'No especificada' : $person_vaccination->lot_number }}
                        </h6>

                        <h6 class="card-text pl-1">
                            <span class="font-weight-bold mr-1"> ¿Esta vacunado?:</span>
                            {{ $person_vaccination->is_vaccinated == 1 ? 'Si' : 'No' }}
                        </h6>

                       <!--  <div class="row w-100 m-0">
                            <div class="col-sm-12 col-lg-6 p-1">
                                <button class="btn btn-sm btn-primary btn-block"
                                    data-id="{{ $person_vaccination->id }}"
                                    data-vaccination-id="{{ $person_vaccination->vaccination_id }}"
                                    data-vaccination-date="{{ $person_vaccination->vaccination_date }}"
                                    data-dose="{{ $person_vaccination->dose }}"
                                    data-lot-number="{{ $person_vaccination->lot_number }}"
                                    data-is-vaccinated="{{ $person_vaccination->is_vaccinated }}" data-action="edit">
                                    Editar
                                    <i class="fa fa-pencil ml-1"></i>
                                </button>
                            </div>

                            @can('remove person vaccination')
                                <div class="col-sm-12 col-lg-6 p-1">
                                    <button class="btn btn-sm btn-danger btn-block"
                                        data-id="{{ $person_vaccination->id }}" data-action="delete">
                                        Eliminar
                                        <i class="fa fa-trash-alt ml-1"></i>
                                    </button>
                                </div>
                            @endcan
                        </div> -->
                    </div>
                </div>
            </div>
        @empty
            @include("components.notResults.notResults")
        @endforelse
    </div>
</section>
