<section class="container mt-5" data-aos="fade-up">
    <div class="row">
        @forelse($user_logs as $user_log)
        <div class="col-sm-12 col-md-6 col-lg-4 px-2 py-2">
            <div class="card">
                
                <div class="card-body">
                    <h6 class="card-title title pl-1">Administrador:
                        <span class="ml-1">
                            {{ $user_log->user->first_name}} {{ $user_log->user->last_name}}
                        </span>
                        
                    </h6>
                    <hr>
                    <h6 class="card-text pl-1">
                       
                        <span class="font-weight-bold mr-1"> Cedula de la persona:</span>
                        {{ $user_log->person_dni }}
                    </h6>

                    <h6 class="card-text pl-1">
                        <span class="font-weight-bold mr-1">
                            Accion: 
                        </span>
                        {{ $user_log->action_type }}
                    </h6>
                </div>
            </div>
        </div>
        @empty
            @include("components.notResults.notResults")
        @endforelse
    </div>
</section>
