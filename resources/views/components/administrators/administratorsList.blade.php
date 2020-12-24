<section class="container mt-5" data-aos="fade-up">
    <div class="row">
        @forelse($administrators as $administrator)
        <div class="col-sm-12 col-md-6 col-lg-4 px-2 py-2">
            <div class="card">
                <img class="card-img-top person-image" 
                    src="{{Storage::url($administrator->image_url)}}" 
                    alt="{{$administrator->first_name}}"
                    title="{{$administrator->first_name}}"
                >
                <div class="card-body">
                    <h5 class="card-title title pl-1">{{$administrator->first_name}} {{$administrator->last_name}}</h5>
                    <div class="row w-100 m-0">
                        <div class="col-sm-12 col-lg-6 p-1">
                            <a class="btn btn-primary btn-block" href="/administradores/{{$administrator->id}}/editar">
                                Editar
                                <i class="fa fa-pencil ml-1"></i>
                            </a>
                        </div>
                        <div class="col-sm-12 col-lg-6 p-1">
                            <a class="btn btn-danger btn-block" data-id="{{$administrator->id}}" data-action="delete">
                                Eliminar
                                <i class="fa fa-trash-alt ml-1"></i>
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
