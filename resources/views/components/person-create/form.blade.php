<section class="container mt-5">
   {{--enctype para enviarse archivos binarios--}}
   <form id="create-person-form" data-aos="fade-up" method="POST" action="/personas"  enctype="multipart/form-data">
      @csrf
      <div class="form-group">
         @error("image")
         <div class="alert alert-danger">
            {{$message}}
         </div>
         @enderror
         <div class="row">
            <div class="col-sm-12 col-md-2 col-lg-1 d-flex align-items-center">
               <a href="{{asset("images/anon.png")}}" 
               data-lightbox="{{asset("images/anon.png")}}"
               class="d-block position-relative text-reset perfil-preview-container"
               >
               <div class="perfil-preview-icon">
                  <i class="fa fa-eye"></i>
               </div>
               <img src="{{asset("images/anon.png")}}" 
               alt="Anoymous user" 
               id="perfil-preview"
               class="rounded-circle" 
               width="80" height="80" 
               style="object-fit: cover;"
               >
               </a>
            </div>
            <div class="col-sm-12 col-md-10 col-lg-11">
               <label for="perfil-photo" class="font-weight-bold mb-2 lead">Foto de perfil</label>
               <button class="btn btn-outline-primary d-block" type="button" id="upload-image">
               Subir imágen <i class="fa fa-file-upload ml-1"></i>
               </button>
               <input type="file" name="image" id="perfil-photo" class="form-control d-none" accept=".jpeg,.jpg,.png,.gif,.bmp,.svg">
            </div>
         </div>
      </div>
      <hr class="my-4" />
      <div class="form-group">
         <div class="row">
            <div class="col-sm-12 col-lg-6 mb-3">
               @error("first_name")
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
               <label for="first-name" class="font-weight-bold mb-2 lead d-block">
               Nombre
               <small class="text-muted float-right font-weight-bold">(requerido)</small>
               </label>
               <input type="text" value="{{old('first_name')}}" class="form-control" name="first_name" id="first-name" placeholder="Juan" autofocus required>
            </div>
            <div class="col-sm-12 col-lg-6">
               @error("last_name")
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
               <label for="last-name" class="font-weight-bold mb-2 lead d-block">
               Apellido
               <small class="text-muted float-right font-weight-bold">(requerido)</small>
               </label>
               <input type="text" value="{{old('last_name')}}" class="form-control" name="last_name" id="last-name" placeholder="Mendoza" required>
            </div>
         </div>
      </div>
      <div class="form-group">
         <div class="row">
            <div class="col-sm-12 col-lg-6 mb-3">
               @error("dni")
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
               <label for="dni" class="font-weight-bold mb-2 lead d-block">
               Cédula
               <small class="text-muted float-right font-weight-bold">(requerido)</small>
               </label>
               <input type="text" value="{{old('dni')}}" class="form-control" name="dni" id="dni" placeholder="0000000" required>
            </div>
            <div class="col-sm-12 col-lg-6">
               @error("phone_number")
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
               <label for="phone-number" class="font-weight-bold mb-2 lead d-block">
               Teléfono
               <small class="text-muted float-right font-weight-bold">(requerido)</small>
               </label>
               <input type="tel" value="{{old('phone_number')}}"  class="form-control" name="phone_number" id="phone-number" placeholder="0000000" required>
            </div>
         </div>
      </div>
      <div class="form-group">
         <div class="row">
            <div class="col-sm-12 col-lg-6 mb-3">
               @error("birthday")
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
               <label for="birthday" class="font-weight-bold mb-2 lead d-block">
               Fecha de nacimiento
               <small class="text-muted float-right font-weight-bold">(requerido)</small>
               </label>
               <input value="{{old('birthday')}}"  type="date" class="form-control" name="birthday" id="birthday" required>
            </div>
            <div class="col-sm-12 col-lg-6 mb-3">
               @error("gender")
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
               <label for="gender" class="font-weight-bold mb-2 lead d-block">
               Género
               <small class="text-muted float-right font-weight-bold">(requerido)</small>
               </label>
               <select name="gender" id="gender" class="form-control" required>
               <option value="femenino" {{ (old("gender") == "femenino" ? "selected":"")}}>Mujer</option>
               <option value="masculino" {{ (old("gender") == "masculino" ? "selected":"")}}>Hombre</option>
               </select>
            </div>
         </div>
         <div class="form-group">
            <div class="row">
               <div class="col-sm-12 col-lg-6">
                     @error("address")
                     <div class="alert alert-danger">
                        {{$message}}
                     </div>
                     @enderror
                     <label for="address" class="font-weight-bold mb-2 lead d-block">
                     Direccion
                     <small class="text-muted float-right font-weight-bold">(requerido)</small>
                     </label>
                     <input type="text" value="{{old('address')}}"  class="form-control" name="address" id="address" placeholder="Avenida Romulo Gallegos N#9" required>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <hr class="my-4" />
      <div class="form-group">
         <div class="row">
            <div class="col-sm-12 col-lg-6 mb-3">
               @error("father_dni")
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
               <label for="father-dni" class="font-weight-bold mb-2 lead d-block">
                  Cédula del padre 
                  <small class="text-muted ml-2 float-right">
                     (opcional)
                     <div class="loader-data" id="loader-dni-father" style="display: none;"></div>
                     <i class="fa fa-exclamation-circle text-danger ml-1" id="dni-father-error" style="display:none;" title="OCURRIÓ UN ERROR DE RED"></i>
                  </small>
               </label>
               <input type="number" class="form-control" value="{{old('father_dni')}}" name="father_dni" id="father-dni" placeholder="0000000">
            </div>
            <div class="col-sm-12 col-lg-6">
               @error("mother_dni")
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
               <label for="mother-number" class="font-weight-bold mb-2 lead d-block">
                  Cédula de la madre 
                  <small class="text-muted ml-2 float-right">
                     (opcional)
                     <div class="loader-data" id="loader-dni-mother" style="display: none;"></div>
                     <i class="fa fa-exclamation-circle text-danger ml-1" id="dni-mother-error" style="display:none;" title="OCURRIÓ UN ERROR DE RED"></i>
                  </small>
               </label>
               <input type="number" class="form-control" value="{{old('mother_dni')}}" name="mother_dni" id="mother-dni" placeholder="0000000">
            </div>
         </div>
      </div>
      <div class="form-group">
         <div class="row">
            <div class="col-12">
               <button class="btn btn-success btn-block" type="submit" id="create-person">
               Crear persona
               <i class="fa fa-arrow-right ml-1"></i>
               </button>
            </div>
         </div>
      </div>
   </form>
</section>