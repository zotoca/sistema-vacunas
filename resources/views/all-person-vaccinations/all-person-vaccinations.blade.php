@extends("components.layout.layout")
@section("title", "Sistema de vacunas » Todas las vacunas de las personas")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.all-person-vaccinations.title")
    @include("components..all-person-vaccinations.form")
    @include("components..all-person-vaccinations.personVaccinationsList")
    @include("components.footer.footer")
@endsection