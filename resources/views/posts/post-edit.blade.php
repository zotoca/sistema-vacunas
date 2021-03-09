@extends("components.layout.layout")
@section("title", "Sistema de vacunas » Editar publicacion")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.post-edit.title")
    @include("components.post-edit.form")
    @include("components.footer.footer")
    <script src={{asset("scripts/js/posts/editPost.js")}} type="module"></script>
@endsection