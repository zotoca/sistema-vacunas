@extends("components.layout.layout")
@section("title", "Sistema de vacunas » Inicio")
@section("body")
    @include("components.navbar.navbar")
   <div class="container mt-5">
          @include("components.home.banner")
          @include("components.home.feactures")
          @include("components.home.mision")
          @include("components.home.vision")
          @include("components.home.galery")
          @include("components.home.OrganizationChart")
          @include("components.footer.footer")
   </div>
@endsection