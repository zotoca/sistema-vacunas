@extends("components.layout.layout")
@section("title", "Sistema de vacunas » Editar administrador")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.administrator-edit.title")
    @include("components.administrator-edit.form")
    @include("components.footer.footer")

    <script src={{asset("scripts/js/administrators/editAdmins.js")}} type="module"></script>
@endsection