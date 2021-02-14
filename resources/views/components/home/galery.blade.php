<div class="section" id="galeria" data-aos="fade-up">
    <h2 class="title title-big title-underline">Galería</h2>
    <p class="lead mt-5">
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab qui 
        cupiditate corrupti officiis quia sit aspernatur iste magni culpa non?
        Labore sapiente, corporis saepe iure, alias totam non provident ipsum 
        perspiciatis excepturi minus, aliquid atque quisquam voluptatibus. 
        Animi eaque possimus voluptatibus ipsam.
    </p>
    <div id="galery-carrusel" class="carousel slide mt-5" data-ride="carousel">
        <div class="carousel-inner">
            @for ($i=1; $i <=3; $i++)
                 <div class="carousel-item {{ $i==1 ? 'active' : ''}}">
                    <a href="{{asset("/images/galery/$i.jpeg")}}" data-lightbox="{{asset("/images/galery/$i.jpeg")}}">
                        <img class="d-block w-100"  src="{{asset("/images/galery/$i.jpeg")}}" alt="First slide" />
                    </a>   
                </div>
            @endfor
        </div>
        <a class="carousel-control-prev" href="#galery-carrusel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#galery-carrusel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
