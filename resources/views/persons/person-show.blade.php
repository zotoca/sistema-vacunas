@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Crear persona")
@section("body")
    @include("components.navbar.navbar-auth")

    <section class="container mt-5">
        <div class="row">
            <img class="rounded-circle" src="{{Storage::url($person->image_url)}}" alt="Imagen de perfil de {{$person->fullName}}" width="100px" height="100px">
            <div class="ml-4">
                <h5>Nombres: <strong>{{ $person->fullName }}</strong></h5>
                <h5>Cedula: {{ $person->dni }}</h5>
                <h5>Edad: {{ $person->age }}</h5>
                <h5>Casa: {{ $person->house->number }}</h5>
                <h5>Calle: {{ $person->house->street->name }}</h5>
                <h5>Numero telefonico: {{ $person->phone_number }}</h5>
            </div>
        </div>
        <div class="mt-5">
            <h5><strong><i class="fa fa-calendar"></i>Fecha de creacion:</strong>{{$person->created_at}}</h5>
            <h5><strong><i class="fa fa-calendar"></i>Fecha de modificacion:</strong>{{$person->updated_at}}</h5>    
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