@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Panel")
@section("body")
    @include("components.navbar.navbar-auth")
    @include("components.dashboard.welcome")
    @include("components.dashboard.summary")
    @include("components.dashboard.actions")
    @include("components.footer.footer")
@endsection