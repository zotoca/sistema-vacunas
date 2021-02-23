@extends("components.layout.layout")
@section("title", "Sistema de vacunas » Crear persona")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.person-create.title")
    @include("components.person-create.form")
    @include("components.footer.footer")
    <script src={{asset("scripts/js/persons/createPerson.js")}} type="module"></script>
@endsection