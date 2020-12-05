@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Vacunas")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.vaccinations.title")
    @include("components.vaccinations.form")
    @include("components.vaccinations.vaccinationList")
    @include("components.vaccinations.pagination")
    @include("components.footer.footer")
    
    <script src={{asset("scripts/js/vaccinations/vaccionations.js")}} type="module"></script>
@endsection