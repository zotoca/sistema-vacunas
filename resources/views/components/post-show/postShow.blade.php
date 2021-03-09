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

   <div class="row mb-3">
      @foreach($post->comments as $comment)
      <div class="col-12 mt-4" data-aos="fade-up">
         <div class="row">
            <div class="col-3 col-sm-3 col-md-2 col-lg-2 mr-0 mr-md-1">
               <img class="shadow-sm d-block post-comment-perfil" 
                  src="{{Storage::url($comment->user->image_url)}}" 
                  alt="Imagen de perfil de {{$comment->user->first_name}}" 
                  title="Imagen de perfil de {{$comment->user->first_name}}" 
                  />
            </div>

            <div class="mr-1 mr-lg-0 col-8 col-sm-8 col-md-9 col-lg-9">
               <h6 class="font-weight-bold">
                  {{$comment->user->first_name}} {{$comment->user->last_name}}
                </h6>

               <p class="post-comment-text">
                  <span>{{$comment->content}}</span>
               </p>
          
               <div>
                  <button class="btn btn-sm btn-primary mr-1" data-action='edit' data-id="{{$comment->id}}">
                  <i class="fa fa-edit"></i>
                  </button>
                  <button class="btn btn-sm btn-danger" data-action='delete' data-id="{{$comment->id}}">
                  <i class="fa fa-trash-alt"></i>
                  </button>
               </div>
            </div>

         </div>
      </div>
      @endforeach
   </div>
</section>