<section class="container mt-5" data-aos="fade-up">
    <input type="hidden" id="person-id" value="{{$person->id}}"></div>
    <div class="d-flex align-items-center">
        <a href="{{ $person->path() }}" class="btn btn-primary mr-3"><i class="fa fa-arrow-left"></i></a>
        <h2 class="title title-big">Vacunas de {{$person->first_name}} {{$person->last_name}}</h2>
    </div>
</section>
