<section class="container mt-5" data-aos="fade-up">
    <div class="row">
        @forelse($persons as $person)
            <div class="col-sm-12 col-md-6 col-lg-4 px-2 py-2">
                <div class="card">
                    <img class="card-img-top person-image" src="{{ Storage::url($person->image_url) }}"
                        alt="{{ $person->first_name }}" title="{{ $person->first_name }}">
                    <div class="card-body">
                        <h5 class="card-title title pl-1">{{ $person->first_name }} {{ $person->last_name }}</h5>
                        <div class="row w-100 m-0">
                            <div class="col-sm-12 col-lg-6 p-1">
                                <a class="btn btn-primary btn-block" href="/personas/{{ $person->id }}/editar">
                                    Editar
                                    <i class="fa fa-edit ml-1"></i>
                                </a>
                            </div>
                            
                            <!-- If the admin CAN delete the person data -->
                            @can('remove person')
                                <div class="col-sm-12 col-lg-6 p-1">
                                    <a class="btn btn-danger btn-block" data-id="{{ $person->id }}" data-action="delete">
                                        Eliminar
                                        <i class="fa fa-trash-alt ml-1"></i>
                                    </a>
                                </div>
                            @endcan
                        </div>

                        <div class="row w-100 m-0">
                            <div class="col-sm-12 col-lg-6 p-1">
                                <a class="btn btn-info btn-block" href="/personas/{{ $person->id }}/vacunas-personas">
                                    Vacunas
                                    <i class="fa fa-syringe ml-1"></i>
                                </a>
                            </div>
                            <div class="col-sm-12 col-lg-6 p-1">
                                <a class="btn btn-info btn-block" href="/personas/{{ $person->id }}">
                                    Ver perfil
                                    <i class="fa fa-eye ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            @include("components.notResults.notResults")
        @endforelse
    </div>
</section>
