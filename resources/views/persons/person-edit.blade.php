@extends("components.layout.layout")
@section("title", "Sistema de vacunas » Crear persona")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.person-edit.title")
    @include("components.person-edit.form")
    @include("components.footer.footer")
    <script src={{asset("scripts/js/persons/editPerson.js")}} type="module"></script>
@endsection