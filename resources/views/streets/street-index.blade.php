@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Calles")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.streets.title")
    @include("components.streets.form")
    @include("components.streets.streetsList")
    @include("components.streets.pagination")
    @include("components.footer.footer")
    
    <script src={{asset("scripts/js/streets/streets.js")}} type="module"></script>
@endsection