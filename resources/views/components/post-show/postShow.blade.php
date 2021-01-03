<section class="container mt-5">
   <div class="row">
      <div class="col-12">
         <div class="d-flex flex-column flex-md-row flex-lg-row align-items-center">
            <img class="shadow-sm d-block mb-2 mb-md-0 mb-lg-0" 
               src="{{Storage::url($post->user->image_url)}}" 
               alt="Imagen de perfil de {{$post->user->first_name}}" 
               title="Imagen de perfil de {{$post->user->first_name}}" 
               width="120" height="120" style="object-fit: cover;"/>



            <div class="ml-0 ml-lg-3 ml-md-3  text-center text-md-left text-lg-left">
               <h5 class="font-weight-bold mb-3">
                  {{$post->user->first_name}} {{$post->user->last_name}}
               </h5>
               <small class="d-block mb-1">
               <span class="font-weight-bold mr-2">
               <i class="fa fa-clock mr-1"></i>
               Publicado en 
               </span>
               {{ date_format($post->created_at, "d/m/Y") }}
               </small>
               <small class="d-block">
               <span class="font-weight-bold mr-2">
               <i class="fa fa-edit mr-1"></i>
               Ultima edición en 
               </span>
               {{ date_format($post->updated_at, "d/m/Y") }}
               </small>
            </div>
         </div>
      </div>

      <div class="col-12">
         <hr class="my-4" />
         <div class="post-content">
            <p>
               {!! $post->content  !!}
            </p>
         </div>
      </div>
   </div>

   <h3 class="title mt-5">Comentarios</h3>
   <hr class="my-4" />
   <form class="text-center" data-aos="fade-up" method="POST" action="/comentarios">
      @csrf
      <input type="hidden" name="post_id" value="{{$post->id}}">
      <div class="form-group">
         @error("content")
         <div class="alert alert-danger">
            {{$message}}
         </div>
         @enderror
         <textarea 
            type="text" 
            class="form-control" 
            name="content" 
            id="content" 
            placeholder="Escribe tu comentario" 
            required></textarea>
      </div>
      <div class="form-group">
         <div class="row">
            <div class="col-12">
               <button class="btn btn-success btn-block" type="submit">
               Crear comentario
               <i class="fa fa-arrow-right ml-1"></i>
               </button>
            </div>
         </div>
      </div>
   </form>

   <div class="row">
      @foreach($post->comments as $comment)
      <div class="col-12 row mt-4" data-aos="fade-up">
         <div class="col-md-2 col-lg-1 mr-0 mr-md-1">
            <img class="shadow-sm d-block" 
               src="{{Storage::url($comment->user->image_url)}}" 
               alt="Imagen de perfil de {{$comment->user->first_name}}" 
               title="Imagen de perfil de {{$comment->user->first_name}}" 
               width="100" height="100" style="object-fit: cover;"/>
         </div>

         <div class="pl-0 pl-lg-2 mr-1 mr-lg-0 col-md-6 col-lg-6">
            <div class="ml-4">
               <h6>
                  <span class="font-weight-bold mr-2">Nombres:</span>
                  <span>{{$comment->user->first_name}} {{$comment->user->last_name}}</span>
               </h6>
            </div>
            <div class="ml-4">
               <p class="post-comment-text">
                  {{$comment->content}}
               </p>
            </div>

            <div class="row ml-4">
               <div class="col-sm-12 col-lg-6 p-1">
                  <button class="btn btn-sm btn-primary btn-block" data-action='edit' data-id="{{$comment->id}}">
                  <i class="fa fa-pencil ml-1"></i>
                  </button>
               </div>
               <div class="col-sm-12 col-lg-6 p-1">
                  <button class="btn btn-sm btn-danger btn-block" data-action='delete' data-id="{{$comment->id}}">
                  <i class="fa fa-trash-alt ml-1"></i>
                  </button>
               </div>
            </div>
         </div>
      </div>
      @endforeach
   </div>
</section>