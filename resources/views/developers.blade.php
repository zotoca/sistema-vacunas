@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Desarrolladores")
@section("body")
    @include("components.navbar.navbar")
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-12 col-md-6">
                <img class="img-fluid" style="height:500px;" src="{{asset("/images/persons.png")}}">
            </div>
            <div class="col-12 col-md-6 mt-5 mt-md-0">
                <h2 class="text-uppercase">Libardo Rengifo</h2>
                <p class="lead ">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Debitis perspiciatis quidem distinctio impedit omnis magni ea suscipit itaque non tenetur, 
                    fugit voluptates nesciunt error magnam voluptatum in aut. Aut, maxime.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsum voluptates maiores, 
                    praesentium laboriosam cumque laborum sunt facere quibusdam sed, quis, porro vel fuga explicabo. 
                    Illo reprehenderit dignissimos cumque animi quasi!
                </p>
                <p class="lead">
                    <a href="https://github.com/znareak"><i class="fa fa-github"></i>Github</a>
                </p>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-12 col-md-6">
                <img class="img-fluid" style="height:500px;" src="{{asset("/images/persons.png")}}">
            </div>
            <div class="col-12 col-md-6 mt-5 mt-md-0">
                <h2 class="text-uppercase">Santiago Padron</h2>
                <p class="lead">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Debitis perspiciatis quidem distinctio impedit omnis magni ea suscipit itaque non tenetur, 
                    fugit voluptates nesciunt error magnam voluptatum in aut. Aut, maxime.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsum voluptates maiores, 
                    praesentium laboriosam cumque laborum sunt facere quibusdam sed, quis, porro vel fuga explicabo. 
                    Illo reprehenderit dignissimos cumque animi quasi!
                </p>
                <p class="lead">
                    <a href="https://github.com/N3CROM4NC3R"><i class="fa fa-github"></i>Github</a>
                </p>
            </div>
        </div>
    </div>
    @include("components.footer.footer")
@endsection