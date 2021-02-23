@extends("components.layout.layout")
@section("title", "Sistema de vacunas » Editar noticia")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.news-edit.title")
    @include("components.news-edit.form")
    @include("components.footer.footer")
    <script src={{asset("scripts/js/news/editNews.js")}} type="module"></script>
@endsection