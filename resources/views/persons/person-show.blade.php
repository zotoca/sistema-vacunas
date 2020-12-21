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

                    <a class="btn btn-outline-info" href="/personas/{{$person->id}}/vacunas-personas">
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
                        {{ $person->created_at }}
                    </h6>

                    <h6>
                        <span class="font-weight-bold mr-2">Fecha de modificación:</span>
                        {{ $person->updated_at }}
                    </h6>

                        @if ($person->father || $person->mother)
                            <h6>
                                <span class="font-weight-bold mr-2 mb-2 d-block">Padres:</span>
                                @if($person->father)
                                    <a href="{{$person->father->path()}}" class="d-block mb-2"> 
                                        <span class="d-block">
                                           <img 
                                            src="{{asset('images/man.png')}}" 
                                           
                                            alt="Father" 
                                            width="20" 
                                            height="20"> 

                                            Padre: {{$person->father->fullName}}
                                        </span>
                                    </a>
                                @endif
                                
                                @if($person->mother)
                                    <a href="{{$person->mother->path()}}" class="d-block"> 
                                        <span class="d-block">
                                            <img 
                                            src="{{asset('images/woman.png')}}" 
                                      
                                            alt="Mother" 
                                            width="20" 
                                            height="20"> 
                                            Madre: {{$person->mother->fullName}}
                                        </span>
                                    </a>
                                @endif
                            </h6>
                        @endif
                  

                    
                        @if($person->sons->count() > 0)
                            <h6>
                            <span class="font-weight-bold mr-2 mb-2 d-block">Hijos:</span>
                            @foreach($person->sons as $son)
                                
                                <a href="{{$son->path()}}" class="d-block">
                                    <span class="d-flex align-items-center">
                                        <img 
                                        src="{{asset('images/son.png')}}" 
                                        class="mr-1"
                                        alt="Mother" 
                                        width="20" 
                                        height="20">
                                        Nro.{{$loop->iteration}} {{$son->fullName}}
                                    </span>
                                </a>
                               
                            @endforeach
                            </h6>
                        @endif
                    
                </div>
            </div>
        </div>

        <!-- @if($person->sons->count() > 0)
            <div>
                <h3>Hijos:</h3>
                @foreach($person->sons as $son)
                    <h5><a href="{{$son->path()}}">Hijo N#{{$loop->iteration}} {{$son->fullName}}</a></h5>
                @endforeach
            <div> 
        @endif -->
    
    </section>
@include("components.footer.footer")
@endsection