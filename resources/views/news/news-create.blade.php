@extends("components.layout.layout")
@section("title", "Sistema de vacunas » Crear noticia")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.news-create.title")
    @include("components.news-create.form")
    @include("components.footer.footer")
    <script src={{asset("scripts/js/news/createNews.js")}} type="module"></script>
@endsection