@extends("components.layout.layout")
@section("title", "Sistema de vacunas » Crear publicacion")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.post-create.title")
    @include("components.post-create.form")
    @include("components.footer.footer")
    <script src={{asset("scripts/js/posts/createPost.js")}} type="module"></script>
@endsection