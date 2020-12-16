@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Crear persona")
@section("body")
    @include("components.navbar.navbar-auth")
    <section class="container mt-5">
        <div class="d-flex align-items-center">
            <a href="/personas" class="btn btn-primary mr-3"><i class="fa fa-arrow-left"></i></a>
            <h2 class="title">Perfil de {{$person->first_name}}</h2>
        </div>
    </section>

    <section class="container mt-5">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <img class="shadow-sm d-block" 
                 src="{{Storage::url($person->image_url)}}" 
                 alt="Imagen de perfil de {{$person->fullName}}" 
                 title="Imagen de perfil de {{$person->fullName}}" 
                 width="100%" height="220px" style="object-fit: cover;"/>

                <div class="btn-group mt-2 w-100" role="group">
                    <a class="btn btn-outline-primary" href="/personas/{{$person->id}}/editar">
                        <i class="fa fa-pencil ml-1"></i>
                    </a>

                    <a class="btn btn-outline-info" href="/personas/{{$person->id}}/vacunas">
                        <i class="fa fa-list-ul ml-1"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 px-0 mt-3 mt-lg-0 mt-md-0">
                <div class="ml-4">
                    <h6>
                        <span class="font-weight-bold mr-2">Nombres:</span>
                        <span>{{ $person->fullName }}</span>
                    </h6>
                    <h6>
                        <span class="font-weight-bold mr-2">Edad:</span>
                        <span>{{ $person->age }}</span>
                    </h6>
                    <h6>
                        <span class="font-weight-bold mr-2">Casa:</span>
                        <span>Nro. {{ $person->house->number }}</span>
                    </h6>
                    <h6>
                        <span class="font-weight-bold mr-2">Calle:</span>
                        <span>{{ $person->house->street->name }}</span>
                    </h6>
                    <h6>
                        <span class="font-weight-bold mr-2">Teléfono:</span>
                        <span class="text-primary">{{ $person->phone_number }}</span>
                    </h6>

                    <hr class="mt-4"/>

                    <h6>
                        <span class="font-weight-bold mr-2">Fecha de creación:</span>
                        {{ date("d-m-Y", strtotime($person->created_at)) }}
                    </h6>

                    <h6>
                        <span class="font-weight-bold mr-2">Fecha de modificación:</span>
                        {{ date("d-m-Y", strtotime($person->updated_at)) }}
                    </h6>
                </div>
            </div>
        </div>

        @if($person->father || $person->mother))
            <div>
                <h3>Padres:</h3>
                @if($person->father)
                    <h5><a href="{{$person->father->path()}}">Padre: {{$person->father->fullName}}</a></h5>
                @endif
                @if($person->mother)
                <h5><a href="{{$person->mother->path()}}">Madre: {{$person->mother->fullName}}</a></h5>
                @endif
            </div>
        @endif
        @if($person->sons->count() > 0)
            <div>
                <h3>Hijos:</h3>
                @foreach($person->sons as $son)
                    <h5><a href="{{$son->path()}}">Hijo N#{{$loop->iteration}} {{$son->fullName}}</a></h5>
                @endforeach
            <div> 
        @endif
    
    </section>
@include("components.footer.footer")
@endsection