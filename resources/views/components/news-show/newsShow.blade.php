<section class="container mt-5">
   <div class="row">
      <div class="col-12">
         <div class="d-flex flex-column flex-md-row flex-lg-row align-items-center">
            <img class="shadow-sm d-block mb-2 mb-md-0 mb-lg-0" 
               src="{{Storage::url($news->user->image_url)}}" 
               alt="Imagen de perfil de {{$news->user->first_name}}" 
               title="Imagen de perfil de {{$news->user->first_name}}" 
               width="120" height="120" style="object-fit: cover;"/>
            <div class="ml-0 ml-lg-3 ml-md-3  text-center text-md-left text-lg-left">
               <h5 class="font-weight-bold mb-3">
                  {{$news->user->first_name}} {{$news->user->last_name}}
               </h5>
               <small class="d-block mb-1">
               <span class="font-weight-bold mr-2">
               <i class="fa fa-clock mr-1"></i>
               Publicado en 
               </span>
               {{ date_format($news->created_at, "d/m/Y") }}
               </small>
               <small class="d-block">
               <span class="font-weight-bold mr-2">
               <i class="fa fa-edit mr-1"></i>
               Ultima edición en 
               </span>
               {{ date_format($news->updated_at, "d/m/Y") }}
               </small>
            </div>
         </div>
      </div>
      <div class="col-12">
         <hr class="my-4" />
         <div class="news-content">
            <p>
               {!! $news->content  !!}
            </p>
         </div>
      </div>
   </div>
</section>