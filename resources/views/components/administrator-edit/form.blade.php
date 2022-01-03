<section class="container mt-5">
    {{-- enctype para enviarse archivos binarios --}}
    <form data-aos="fade-up" method="POST" action="{{ $administrator->path() }}" enctype="multipart/form-data"
        id="edit-admin-form">
        @csrf
        <input name="_method" value="PUT" type="hidden">
        <div class="form-group">
            @error('image')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            <div class="row">
                <div class="col-sm-12 col-md-2 col-lg-1 d-flex align-items-center">
                    <a href='{{ $administrator->image_url != 'person.png' ? Storage::url($administrator->image_url) : asset('images/anon.png') }}'
                        data-lightbox='{{ $administrator->image_url != 'person.png' ? Storage::url($administrator->image_url) : asset('images/anon.png') }}'
                        class="d-block position-relative text-reset perfil-preview-container">
                        <div class="perfil-preview-icon">
                            <i class="fa fa-eye"></i>
                        </div>
                        {{-- aqui se puede hacer una comprobacion si el user tiene imagen
                  ponerle la url de la imagen, sino dejarle la de anonimo --}}
                        <img src='{{ $administrator->image_url != 'person.png' ? Storage::url($administrator->image_url) : asset('images/anon.png') }}'
                            alt="Anoymous user" id="perfil-preview" class="rounded-circle" width="80" height="80"
                            style="object-fit: cover;">
                    </a>
                </div>
                <div class="col-sm-12 col-md-10 col-lg-11">
                    <label for="perfil-photo" class="font-weight-bold mb-2 lead">Foto de perfil</label>
                    <button class="btn btn-outline-primary d-block" type="button" id="upload-image">
                        Subir imágen <i class="fa fa-file-upload ml-1"></i>
                    </button>
                    <input type="file" name="image" id="perfil-photo" class="form-control d-none"
                        accept=".jpeg,.jpg,.png,.gif,.bmp,.svg">
                </div>
            </div>
        </div>
        <hr class="my-4" />
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12 col-lg-6 mb-3">
                    @error('first_name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="first-name" class="font-weight-bold mb-2 lead d-block">
                        Nombre
                        <small class="text-muted float-right font-weight-bold">(requerido)</small>
                    </label>
                    <input type="text" value="{{ $administrator->first_name }}" class="form-control"
                        name="first_name" id="first-name" placeholder="Juan" autofocus required>
                </div>
                <div class="col-sm-12 col-lg-6">
                    @error('last_name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="last-name" class="font-weight-bold mb-2 lead d-block">
                        Apellido
                        <small class="text-muted float-right font-weight-bold">(requerido)</small>
                    </label>
                    <input type="text" value="{{ $administrator->last_name }}" class="form-control" name="last_name"
                        id="last-name" placeholder="Mendoza" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    @error('email')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="email" class="font-weight-bold mb-2 lead d-block">
                        Correo electronico
                        <small class="text-muted float-right font-weight-bold">(requerido)</small>
                    </label>
                    <input type="email" value="{{ $administrator->email }}" class="form-control" name="email"
                        id="email" placeholder="Correo electronico" required>
                </div>

            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12 col-lg-6 mb-3">
                    @error('password')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="password" class="font-weight-bold mb-2 lead d-block">
                        Contraseña
                    </label>
                    <input type="password" value="" class="form-control" name="password" id="password"
                        placeholder="0000000">
                </div>
                <div class="col-sm-12 col-lg-6">
                    @error('repeatPassword')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="repeatPassword" class="font-weight-bold mb-2 lead d-block">
                        Confirmar contraseña
                    </label>
                    <input type="password" value="" class="form-control" name="repeatPassword" id="repeatPassword"
                        placeholder="0000000">
                </div>

                <div class="col-12 mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="delete_vaccine_permission"
                            id="deleteVaccunePermission">
                        <label class="form-check-label" for="deleteVaccunePermission">
                            Ortogar permisos para eliminar vacunas
                        </label>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="delete_person_permission"
                            id="deletePersonPermission">
                        <label class="form-check-label" for="deletePersonPermission">
                            Eliminar personas
                        </label>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=""
                            name="delete_person_vaccination_permission" id="deletePersonVaccinationPermission">
                        <label class="form-check-label" for="deletePersonVaccinationPermission">
                            Eliminar las vacunas de las personas
                        </label>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <hr class="my-4" />

        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-success btn-block" type="submit" id="edit-admin">
                        Editar administrador
                        <i class="fa fa-arrow-right ml-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</section>
