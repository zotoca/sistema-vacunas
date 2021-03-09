@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Desarrolladores")
@section("body")
    @include("components.navbar.navbar")
    <div class="container pt-5">
        <div class="row my-5">
            <div class="col-12 col-md-6" data-aos="fade-up">
                <img class="img-fluid w-100"  src="{{asset("/images/persons.png")}}">
            </div>
            <div class="col-12 col-md-6 mt-5 mt-md-0" data-aos="fade-up" data-aos-delay="300">
                <h4 class="title text-uppercase mb-4">Libardo Rengifo</h4>
                <p class="lead mt-2">
                    Programador junior en el área web, dominante en 
                    <span class="language">ReactJS</span> 
                    y preprocesadores como <span class="language">SASS</span>.
                    <br />
                    Aspirante a crear aplicaciones complejas mediante el aprendizaje de nuevas tecnologías
                    
                </p>
                <p class="lead">
                    <a href="https://github.com/znareak" class="text-reset">
                        <i class="fa fa-github mr-2"></i>Github
                    </a>
                </p>
            </div>
        </div>
        <br />
        <div class="row flex-column-reverse flex-md-row my-5">
            <div class="col-12 col-md-6 mt-5 mt-md-0" data-aos="fade-up" data-aos-delay="300">
                <h4 class="title text-uppercase mb-4">Santiago Padron</h4>
                <p  class="lead mt-2">
                    Desarrollador web
                    <span class="language">PHP</span> + 
                    <span class="language">Javascript</span>,
                    amante de las tecnologías y del aprendizaje.
                    <br/>
                    La educación formal la mayoria de las veces
                    nos enseña que aprender, pero no como aprenderlo.

                    <blockquote class="blockquote">
                        <p class="mb-0">
                            Dame 6 horas para cortar un árbol y pasaré 4 afilando el hacha
                        </p>
                        <footer class="blockquote-footer">
                            Abraham Lincoln
                        </footer>
                    <blockquote>
                </p>
                <p class="lead">
                    <a href="https://github.com/N3CROM4NC3R" class="text-reset">
                        <i class="fa fa-github mr-2"></i>Github
                    </a>
                </p>
            </div>
            <div class="col-12 col-md-6" data-aos="fade-up">
                <img class="img-fluid w-100" src="{{asset("/images/dev/necromancer.jpg")}}">
            </div>
        </div>
    </div>
    @include("components.footer.footer")
@endsection