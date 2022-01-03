<section class="container mt-5" data-aos="fade-up">
    <div class="row">
        @forelse($news as $news_element)
        <div class="col-sm-12 col-md-6 col-lg-4 px-2 py-2">
            <div class="card">
                <img class="card-img-top news-image" 
                    src="{{Storage::url($news_element->image_url)}}" 
                    alt="{{$news_element->title}}"
                    title="{{$news_element->title}}"
                >
                <div class="card-body">
                    <h5 class="card-title title pl-1">{{$news_element->title}}</h5>
                    @auth
                        <div class="row w-100 m-0">
                            <div class="col-sm-12 col-lg-6 p-1">
                                <a class="btn btn-primary btn-block" href="{{$news_element->path()}}/editar">
                                    Editar
                                    <i class="fa fa-edit ml-1"></i>
                                </a>
                            </div>
                            <div class="col-sm-12 col-lg-6 p-1">
                                <a class="btn btn-danger btn-block" data-id="{{$news_element->id}}" data-action="delete">
                                    Eliminar
                                    <i class="fa fa-trash-alt ml-1"></i>
                                </a>
                            </div>
                        </div>
                    @endauth
                    <div class="row w-100 m-0">
                    
                        <div class="col-sm-12 col-lg-6 p-1">
                            <a class="btn btn-info btn-block" href="{{$news_element->path()}}">
                                Ver noticia
                                <i class="fa fa-eye ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
            @include("components.notResults.notResults")
        @endforelse
    </div>
</section>
