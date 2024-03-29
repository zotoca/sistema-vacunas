@extends("components.layout.layout")
@section("title", "Sistema de vacunas » Iniciar sesion")
@section("body")
@include("components.navbar.navbar")

<section class="container mt-5" data-aos="fade-up">
    <div class="row pt-4" data-aos="fade-up">
        <img class="col-lg-6 offset-lg-3 col-12 rounded-sm img-login" src="{{asset("images/lading_page.png")}}" class="img-fluid" alt="">
        <div class="col-lg-6 offset-lg-3 col-12 mt-4">
            <h2 class="text-center title mb-4">Iniciar sesion</h2>
            <form action="/do-login" method="POST">
                @csrf
                @error("login")
                    <div class="alert alert-danger">
                        <i class="fa fa-times mr-1"></i>
                        {{$message}}
                    </div>
                @enderror
                <div class="form-group">
                    <div class="input-group">
                        
                        <input type="email" class="form-control" placeholder="Email" name="email" autofocus required>
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
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
                <div class="container px-0">
                    <a class="link" data-toggle="collapse" type="button" href="#recovery-password-collapsable" data-target="#recovery-password-collapsable" aria-expanded="false" aria-controls="recovery-password-collapsable">
                        <i class="fa fa-key mr-1"></i>
                        Recuperar contraseña
                    </a>
                </div>

                <div class="collapse multi-collapse mb-3" id="recovery-password-collapsable">
                    <div class="card card-body">
                        Si has perdido tu contraseña, contacta con el soporte tecnico, envia un mensaje a cualquiera de estos correos electronicos para confirmar tu identidad.
                        <ul>
                            <li>santi16648@gmail.com</li>
                            <li>libardojesusrengifo129@gmail.com</li>
                            
                        </ul>
                    </div>
                </div>
            </form>    
        </div>
    </div>
</section>
@endsection