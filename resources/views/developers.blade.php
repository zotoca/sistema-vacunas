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
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Debitis perspiciatis quidem distinctio impedit omnis magni ea suscipit itaque non tenetur, 
                    fugit voluptates nesciunt error magnam voluptatum in aut. Aut, maxime.
                    Lorem ipsum dolor
                </p>
                <p class="lead">
                    <a href="https://github.com/znareak" class="text-reset">
                        <i class="fa fa-github mr-2"></i>Github
                    </a>
                </p>
            </div>
        </div>
        <br />
        <div class="row my-5">
            <div class="col-12 col-md-6 mt-5 mt-md-0" data-aos="fade-up" data-aos-delay="300">
                <h4 class="title text-uppercase mb-4">Santiago Padron</h4>
                <p  class="lead mt-2">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Debitis perspiciatis quidem distinctio impedit omnis magni ea suscipit itaque non tenetur, 
                    fugit voluptates nesciunt error magnam voluptatum in aut. Aut, maxime.
                    Lorem ipsum dolor
                </p>
                <p class="lead">
                    <a href="https://github.com/N3CROM4NC3R" class="text-reset">
                        <i class="fa fa-github mr-2"></i>Github
                    </a>
                </p>
            </div>
            <div class="col-12 col-md-6" data-aos="fade-up">
                <img class="img-fluid w-100" src="{{asset("/images/persons.png")}}">
            </div>
        </div>
    </div>
    @include("components.footer.footer")
@endsection