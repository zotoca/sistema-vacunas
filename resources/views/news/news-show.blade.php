@extends("components.layout.layout")
@section("title", "Sistema de vacunas » Ver noticia")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.news-show.title")
    @include("components.news-show.newsShow")
    @include("components.footer.footer")
@endsection