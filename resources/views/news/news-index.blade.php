@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Noticias")
@section("body")
    @auth
        @include("components.navbar.navbar-auth")
    @endauth
    @guest
        @include("components.navbar.navbar")
    @endguest
    @include("components.news.title")
    @include("components.news.form")
    @include("components.news.newsList")
    @include("components.news.pagination")
    @include("components.footer.footer")
    
    <script src={{asset("scripts/js/news/deleteNews.js")}} type="module"></script>
@endsection