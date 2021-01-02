<section class="container mt-5">
   <div class="row">
      <div class="col-md-6 col-lg-3">
         <img class="shadow-sm d-block" 
            src="{{Storage::url($post->user->image_url)}}" 
            alt="Imagen de perfil de {{$post->user->first_name}}" 
            title="Imagen de perfil de {{$post->user->first_name}}" 
            width="100%" height="110px" style="object-fit: cover;"/>
         
      </div>
      <div class="col-md-6 col-lg-4 px-0 mt-3 mt-lg-0 mt-md-0">
         <div class="ml-4">   
         <p>{{$post->user->first_name}} {{$post->user->last_name}}</p>
            
            <h6>
               <span class="font-weight-bold mr-2">Fecha de creación:</span>
               {{ $post->created_at }}
            </h6>
            <h6>
               <span class="font-weight-bold mr-2">Fecha de modificación:</span>
               {{ $post->updated_at }}
            </h6>
            
         </div>
      </div>
      <div class="col-12 " style="width:100px !important;">
        {!! $post->content  !!}
      </div>
   </div>

      <h3 class="title mt-5">Comentarios</h3>
     <hr class="my-4" />
      <form class="text-center" data-aos="fade-up" method="POST" action="/comentarios">
         @csrf
         <input type="hidden" name="post_id" value="{{$post->id}}">
         
         <div class="form-group">
            <div class="row">
               <div class="col-sm-12 col-lg-12 mb-3">
                  @error("content")
                  <div class="alert alert-danger">
                     {{$message}}
                  </div>
                  @enderror
                  <textarea type="text" class="form-control" name="content" id="content" placeholder="Escribe tu comentario" required>
                  </textarea>
               </div>
            </div>
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
      <div class="col-12 row mt-4">
         <div class="col-md-6 col-lg-3">
            <img class="shadow-sm d-block" 
               src="{{Storage::url($comment->user->image_url)}}" 
               alt="Imagen de perfil de {{$comment->user->first_name}}" 
               title="Imagen de perfil de {{$comment->user->first_name}}" 
               width="100%" height="220px" style="object-fit: cover;"/>
         </div>
         <div class="col-md-6 col-lg-4 px-0 mt-3 mt-lg-0 mt-md-0">
            <div class="ml-4">
               <h6>
                  <span class="font-weight-bold mr-2">Nombres:</span>
                  <span>{{$comment->user->first_name}} {{$comment->user->last_name}}</span>
               </h6>
            </div>
            <div class="ml-4">
               <h6>
                  <span>{{$comment->content}}</span>
               </h6>
            </div>  
            <div class="row ml-4">
               <div class="col-sm-12 col-lg-6 p-1">
                  <button class="btn btn-primary btn-block" data-action='edit' data-id="{{$comment->id}}">
                     Editar
                     <i class="fa fa-pencil ml-1"></i>
                  </button>
               </div>
               <div class="col-sm-12 col-lg-6 p-1">
                  <button class="btn btn-danger btn-block" data-action='delete' data-id="{{$comment->id}}">
                     Eliminar
                     <i class="fa fa-trash-alt ml-1"></i>
                  </button>
               </div>
            </div> 
         </div>
         
      </div>

      @endforeach
   </div>
</section>