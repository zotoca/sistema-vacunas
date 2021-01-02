<section class="container mt-5">
   {{--enctype para enviarse archivos binarios--}}
   <form id="create-post-form" data-aos="fade-up" method="POST" action="/foro"  enctype="multipart/form-data">
      @csrf
      <hr class="my-4" />
      <div class="form-group">
         <div class="row">
            <div class="col-12">
               @error("title")
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
               <label for="title" class="font-weight-bold mb-2 lead d-block">
               Titulo
               <small class="text-muted float-right font-weight-bold">(requerido)</small>
               </label>
               <input type="text" value="{{old('title')}}" class="form-control" name="title" id="title" placeholder="Titulo" autofocus required>
            </div>
            
         </div>
      </div>
      <div class="form-group">
         <div class="row">
            <div class="col-12">
               @error("image")
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
               <label for="image" class="font-weight-bold mb-2 lead d-block">
               Imagen
               <small class="text-muted float-right font-weight-bold">(Opcional)</small>
               </label>
               <input type="file" class="form-control-file" name="image" id="image" accept="image/*">
            </div>
         </div>
      </div>
      <div class="form-group">
         <div class="row">
            <div class="col-12">
               @error("content")
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
               <label for="content" class="font-weight-bold mb-2 lead d-block">
               Contenido
               <small class="text-muted float-right font-weight-bold">(requerido)</small>
               </label>
               <textarea name="content" id="content"></textarea>
            </div>
         </div>
      </div>
      
      <div class="form-group">
         <div class="row">
            <div class="col-12">
               <button class="btn btn-success btn-block" type="submit" id="create-post">
               Crear publicacion
               <i class="fa fa-arrow-right ml-1"></i>
               </button>
            </div>
         </div>
      </div>
   </form>
</section>