@extends("components.layout.layout")
@section("title", "Sistema vacunativo » Crear persona")
@section("body")
    @include("components.navbar.navbar-auth")
    <section class="container mt-5">
        <div class="d-flex align-items-center">
            <a href="/personas" class="btn btn-primary mr-3"><i class="fa fa-arrow-left"></i></a>
            <h2 class="title title-big">Editar persona</h2>
        </div>
    </section>

    <section class="container mt-5">
       {{--enctype para enviarse archivos binarios--}}
        <form action="{{$person->path()}}" method="POST" data-aos="fade-up" enctype="multipart/form-data" id="edit-person-form">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" id="person-id" name="person_id" value="{{ $person->id }}">
            <input type="hidden" id="person-street-id" name="person_street_id" value="{{ $person->house->street->id }}">
            <input type="hidden" id="person-house-id" name="person_house_id" value="{{ $person->house->id }}">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 col-md-2 col-lg-1 d-flex align-items-center">
                        <a href='{{$person->image_url != "person.png"?Storage::url($person->image_url):asset("images/anon.png")}}' 
                            data-lightbox='{{$person->image_url != "person.png"?Storage::url($person->image_url):asset("images/anon.png")}}'
                            class="d-block position-relative text-reset perfil-preview-container"
                        >
                            <div class="perfil-preview-icon">
                                <i class="fa fa-eye"></i>
                            </div>
                            {{-- aqui se puede hacer una comprobacion si el user tiene imagen
                                ponerle la url de la imagen, sino dejarle la de anonimo
                            --}}
                            
                            <img src='{{$person->image_url != "person.png"?Storage::url($person->image_url):asset("images/anon.png")}}' 
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
                        <input type="text" class="form-control" name="first_name" id="first-name" placeholder="Juan" value="{{$person->first_name}}" autofocus required>
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
                        <input type="text" class="form-control" name="last_name" id="last-name" placeholder="Mendoza" value="{{$person->last_name}}" required>
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
                            <small class="text-muted float-right font-weight-bold">
                                (requerido)
                                <div class="loader-data" id="loader-dni-person" style="display: none;"></div>
                            </small>
                        </label>
                        <input type="number" class="form-control" name="dni" id="dni" placeholder="0000000" value="{{$person->dni}}" required>
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
                        <input type="number" class="form-control" name="phone_number" id="phone-number" value="{{$person->phone_number}}" placeholder="0000000" required>
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
                        <input type="date" class="form-control" name="birthday" id="birthday" value="{{$person->birthday}}" required>
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
                            <option {{ $person->gender == 'femenino'?"selected":""}} value="femenino">Mujer</option>
                            <option {{ $person->gender == 'masculino'?"selected":""}} value="masculino">Hombre</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 col-lg-6 mb-3">
                        
                        <label for="street-id" class="font-weight-bold mb-2 lead d-block">
                            Calle
                            <small class="text-muted float-right font-weight-bold">
                                (requerido)
                                <div class="loader-data" id="loader-street"></div>
                                <i class="fa fa-exclamation-circle text-danger ml-1" id="street-error" style="display:none;" title="OCURRIÓ UN ERROR DE RED"></i>
                            </small>
                        </label>
                        <select name="street_id" id="street-id"  class="form-control" required disabled>
                        </select>
                    </div>

                    <div class="col-sm-12 col-lg-6">
                        @error("house_id")
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        <label for="house-id" class="font-weight-bold mb-2 lead d-block">
                            Casa
                            <small class="text-muted float-right font-weight-bold">
                                (requerido)
                                <div class="loader-data" id="loader-house"></div>
                                <i class="fa fa-exclamation-circle text-danger ml-1" id="house-error" style="display:none;" title="OCURRIÓ UN ERROR DE RED"></i>
                            </small>
                        </label>
                        <select name="house_id" id="house-id"  class="form-control" required disabled>

                        </select>
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
                        <input type="number" class="form-control" name="father_dni" id="father-dni" value="{{$person->father_dni}}" placeholder="0000000">
                    </div>

                    <div class="col-sm-12 col-lg-6">
                        @error("mother_dni")
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        <label for="mother-dni" class="font-weight-bold mb-2 lead d-block">
                            Cédula de la madre 
                            <small class="text-muted ml-2 float-right">
                                (opcional)
                                <div class="loader-data" id="loader-dni-mother" style="display: none;"></div>
                                <i class="fa fa-exclamation-circle text-danger ml-1" id="dni-mother-error" style="display:none;" title="OCURRIÓ UN ERROR DE RED"></i>
                            </small>
                        </label>
                        <input type="number" class="form-control" name="mother_dni" id="mother-dni" value="{{$person->mother_dni}}" placeholder="0000000">
                    </div>
                </div>
            </div>

            <hr class="my-4" />

          <!--   <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 col-lg-6 mb-3">
                    
                        <label for="vaccination-id" class="font-weight-bold mb-2 lead d-block">
                            Vacuna
                            <small class="text-muted ml-2 float-right">(opcional)</small>
                        </label>
                        <select name="vaccination_id" id="vaccination-id" class="form-control">
                            <option value="triple viridica">Triple virídica</option>
                        </select>
                    </div>

                    <div class="col-sm-12 col-lg-6">
                        <label for="vaccionation-dose" class="font-weight-bold mb-2 lead d-block">
                            Dosis
                            <small class="text-muted ml-2 float-right">(opcional)</small>
                        </label>
                        <input type="text" class="form-control" name="vaccionation_dose" id="vaccionation-dose">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 col-lg-6 mb-3">
                        <label for="vaccionation-lot" class="font-weight-bold mb-2 lead d-block">
                            Nro. de Lote
                            <small class="text-muted ml-2 float-right">(opcional)</small>
                        </label>
                        <input type="text" class="form-control" name="vaccionation_lot" id="vaccionation-lot">
                    </div>

                    <div class="col-sm-12 col-lg-6">
                        <label for="vaccination-date" class="font-weight-bold mb-2 lead d-block">
                            Fecha de vacuna
                            <small class="text-muted ml-2 float-right">(opcional)</small>
                        </label>
                        <input type="date" class="form-control" name="vaccination_date" id="vaccination-date">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="is-vaccinate" class="font-weight-bold mb-2 lead d-block">
                    ¿Está vacunado?
                </label>
                <input type="checkbox" name="is_vaccinate" id="is-vaccinate">
            </div>
          -->
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 col-lg-6 mb-2">
                        <button class="btn btn-success btn-block" type="submit" id="edit-person">
                            Editar persona
                            <i class="fa fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <a class="btn btn-primary btn-block" href="{{$person->path()}}/vacunas-personas">
                            Ver vacunas                            
                            <i class="fa fa-list ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </section>
    @include("components.footer.footer")
    <script src={{asset("scripts/js/persons/editPerson.js")}} type="module"></script>
@endsection