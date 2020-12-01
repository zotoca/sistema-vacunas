@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Iniciar sesion")
@section("body")
@include("components.navbar.navbar")
<section class="container mt-5">
    <div class="row">
        <img class="col-lg-6 offset-lg-3 col-12" src="{{asset("images/lading_page.png")}}" class="img-fluid" alt="">
        <div class="col-lg-6 offset-lg-3 col-12">
            <h2 class="text-center">Iniciar sesion</h2>
            <form action="/do-login" method="POST">
                @csrf
                @error("login")
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
                <div class="form-group">
                    <div class="input-group">
                        
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Contraseña" name="password">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <button class="btn btn-primary btn-block">Ok<i class="fa fa-check ml-2"></i></button>
                    </div>
                </div>
            </form>    
        </div>
    </div>
</section>
@endsection