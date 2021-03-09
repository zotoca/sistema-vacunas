@extends("components.layout.layout")
@section("title", "Sistema de vacunas » Administradores")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.administrators.title")
    @include("components.administrators.form")
    @include("components.administrators.administratorsList")
    @include("components.administrators.pagination")
    @include("components.footer.footer")
    
    <script src={{asset("scripts/js/administrators/deleteAdmins.js")}} type="module"></script>
@endsection