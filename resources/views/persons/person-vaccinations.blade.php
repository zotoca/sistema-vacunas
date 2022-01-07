@extends("components.layout.layout")
@section('title', 'Sistema de vacunas » Vacunas')
@section('body')
    @include("components.navbar.navbar-auth")
    @include("components.person-vaccination.title")
    @include("components.person-vaccination.form")
    @include("components.person-vaccination.personVaccinationsList")
    @include("components.footer.footer")

    <script src={{ asset('scripts/js/personVaccination/personVaccination.js') }} type="module"></script>
    <script src="{{ asset('scripts/js/all-person-vaccinations/printVaccinations.js') }}"></script>
@endsection
