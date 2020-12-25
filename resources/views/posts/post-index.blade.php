@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Publicaciones")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.posts.title")
    @include("components.posts.form")
    @include("components.posts.postsList")
    @include("components.posts.pagination")
    @include("components.footer.footer")
    
    <script src={{asset("scripts/js/posts/deletePosts.js")}} type="module"></script>
@endsection