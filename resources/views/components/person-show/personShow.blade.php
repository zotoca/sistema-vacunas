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
               
               <i class="fa fa-edit mr-1"></i>
               Editar
            </a>
            <a class="btn btn-outline-info" href="/personas/{{$person->id}}/vacunas-personas">
               
               <i class="fa fa-syringe mr-1"></i>
               Vacunas
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
               <span class="font-weight-bold mr-2">Fecha de nacimiento:</span>
               <span>{{ $person->birthday }}</span>
            </h6>
            <h6>
               <span class="font-weight-bold mr-2">Edad:</span>
               <span>{{ $person->age }}</span>
            </h6>
            <h6>
               <span class="font-weight-bold mr-2">Casa:</span>
               <span>Nro. {{ $person->address }}</span>
            </h6>
            <h6>
               <span class="font-weight-bold mr-2">Teléfono:</span>
               <span class="text-primary">{{ $person->phone_number }}</span>
            </h6>
            <hr class="mt-4"/>
            <h6>
               <span class="font-weight-bold mr-2">Fecha de creación:</span>
               {{ date_format($person->created_at, "d/m/Y") }}
            </h6>
            <h6>
               <span class="font-weight-bold mr-2">Fecha de modificación:</span>
               {{ date_format($person->updated_at, "d/m/Y") }}
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
               <a href="{{$son->path()}}" class="d-block mb-1">
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
</section>