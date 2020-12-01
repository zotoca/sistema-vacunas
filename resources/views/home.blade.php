@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Inicio")
@section("body")
    @include("components.navbar.navbar")
   <div class="container mt-5">
          @include("components.home.banner")
          @include("components.home.feactures")
          @include("components.home.mision")
          @include("components.home.vision")
          @include("components.home.galery")
   </div>
@endsection