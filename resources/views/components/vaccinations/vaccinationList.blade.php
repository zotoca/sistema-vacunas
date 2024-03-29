<section class="container mt-5" data-aos="fade-up">
    <div class="row">
        @forelse($vaccinations as $vaccination)
            <div class="col-sm-12 col-md-6 col-lg-4 px-2 py-2">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('/images/vacunas.png') }}"
                        alt="{{ $vaccination->name }}" title="{{ $vaccination->name }}">
                    <div class="card-body">
                        <h5 class="card-title title pl-1">{{ $vaccination->name }}</h5>
                        <div class="row w-100 m-0">
                            <div class="col-sm-12 col-lg-6 p-1">
                                <button class="btn btn-primary btn-block" data-id="{{ $vaccination->id }}"
                                    data-action="edit">
                                    Editar
                                    <i class="fa fa-edit ml-1"></i>
                                </button>
                            </div>

                            <!-- If the admin CAN delete the vaccine data -->
                            @can('remove vaccine')
                                <div class="col-sm-12 col-lg-6 p-1">
                                    <button class="btn btn-danger btn-block" data-id="{{ $vaccination->id }}"
                                        data-action="delete">
                                        Eliminar
                                        <i class="fa fa-trash-alt ml-1"></i>
                                    </button>
                                </div>
                            @endcan

                        </div>
                    </div>
                </div>
            </div>
        @empty
            @include("components.notResults.notResults")
        @endforelse
    </div>
</section>
