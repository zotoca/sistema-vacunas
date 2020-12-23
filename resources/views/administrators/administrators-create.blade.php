@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Crear administrador")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.administrator-create.title")
    @include("components.administrator-create.form")
    @include("components.footer.footer")
    <script src={{asset("scripts/js/administrators/createAdmin.js")}} type="module"></script>

@endsection