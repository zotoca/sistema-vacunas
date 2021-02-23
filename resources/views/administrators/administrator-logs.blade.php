@extends("components.layout.layout")
@section("title", "Sistema de vacunas » Registro de acciones")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.administrator-logs.title")
    @include("components.administrator-logs.form")
    @include("components.administrator-logs.administratorLogsList")
    @include("components.footer.footer")
@endsection