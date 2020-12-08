@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Personas")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.persons.title")
    @include("components.persons.form")
    @include("components.persons.personsList")
    @include("components.persons.pagination")
    @include("components.footer.footer")
    
    <script src={{asset("scripts/js/houses/house.js")}} type="module"></script>
@endsection