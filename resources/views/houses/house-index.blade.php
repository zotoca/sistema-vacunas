@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Casas")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.houses.title")
    @include("components.houses.form")
    @include("components.houses.housesList")
    @include("components.houses.pagination")
    @include("components.footer.footer")
    
    <script src={{asset("scripts/js/houses/house.js")}} type="module"></script>
@endsection