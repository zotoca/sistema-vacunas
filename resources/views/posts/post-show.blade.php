@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Ver publicacion")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.post-show.title")
    @include("components.post-show.postShow")
    @include("components.footer.footer")
    <script src={{asset("scripts/js/comments/editComments.js")}} type="module"></script>
    <script src={{asset("scripts/js/comments/deleteComments.js")}} type="module"></script>
    <script src={{asset("scripts/js/comments/showMoreText.js")}} type="module"></script>
@endsection