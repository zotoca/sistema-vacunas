@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Vacunas")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.person-vaccination.title")
    @include("components.person-vaccination.form")
    @include("components.person-vaccination.personVaccinationsList")
    @include("components.footer.footer")
    
    <script src={{asset("scripts/js/personVaccination/personVaccination.js")}} type="module"></script>
@endsection