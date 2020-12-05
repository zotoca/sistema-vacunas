<section class="container mt-5">
    <div class="row">
        @forelse($streets as $street)
        <div class="col-sm-12 col-md-6 col-lg-4 px-2 py-2">
            <div class="card">
                <img class="card-img-top" src="{{asset("/images/streets.png")}}" alt="{{$street->name}}" title="{{$street->name}}">
                <div class="card-body">
                    <h5 class="card-title title pl-1">{{$street->name}}</h5>
                    <div class="row w-100 m-0">
                        <div class="col-sm-12 col-lg-6 p-1">
                            <button class="btn btn-primary btn-block" data-id="{{$street->id}}" data-action="edit">
                                Editar
                                <i class="fa fa-pencil ml-1"></i>
                            </button>
                        </div>
                        <div class="col-sm-12 col-lg-6 p-1">
                            <button class="btn btn-danger btn-block" data-id="{{$street->id}}" data-action="delete">
                                Eliminar
                                <i class="fa fa-trash-alt ml-1"></i>
                            </button>
                        </div>
                        <div class="col-12 p-1">
                            <button class="btn btn-primary btn-block" href="/calles/{{$street->id}}/casas">Casas <i class="fa fa-home ml-1"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <h1>Sin calles aun</h1>
        @endforelse
    </div>
</section>
