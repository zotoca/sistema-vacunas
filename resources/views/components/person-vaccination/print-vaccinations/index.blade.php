<div>
    <link rel="stylesheet" href="{{ asset('styles/fonts/fonts.lato.google.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/fonts/fonts.archivoblack.google.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/printVaccinations.css') }}">

    <div class="container" id="document">
        <div id="ignorePDF">
            <button id="print">Imprimir documento</button>
        </div>

        <h2 class="title">Sistema de Vacunas Morichal</h2>

        <div class="row">
            <div class="column">
                <strong class="data-title">Datos Personales</strong>

                <p class="info">
                    <span>Nombre Completo: </span>
                    <span class="info-data">
                        {{ $person->first_name }} {{ $person->last_name }}
                    </span>
                </p>
                <p class="info">
                    <span>Fecha de nacimiento: </span>
                    <span class="info-data">
                        {{ $person->birthday }}
                    </span>

                </p>
                <p class="info">
                    <span>Edad: </span>
                    <span class="info-data">
                        {{ $person->age < 1 ? 'no especificado' : $person->age }}
                    </span>

                </p>
                <p class="info">
                    <span>Teléfono:</span>
                    <span class="info-data">
                        {{ $person->phone_number === '' ? 'no especificado' : $person->phone_number }}
                    </span>

                </p>
            </div>
            <div class="column">
                <img class="img" src="{{ Storage::url($person->image_url) }}"
                    alt="Imagen de perfil de {{ $person->fullName }}"
                    title="Imagen de perfil de {{ $person->fullName }}" width="100%" height="220px" />
            </div>
        </div>

        <table>
            <tr>
                <th>Vacuna</th>
                <th>Fecha de vacunación</th>
                <th>Dosís</th>
                <th>Lote</th>
                <th>Vacunado</th>
            </tr>

            @foreach ($person_vaccinations as $person_vaccination)
                <tr>
                    <td>

                        {{ $person_vaccination->vaccination->name }}
                    </td>
                    <td>
                        {{ $person_vaccination->vaccination_date }}
                    </td>
                    <td>
                        {{ $person_vaccination->dose == '' ? 'No especificada' : $person_vaccination->dose }}
                    </td>
                    <td>
                        {{ $person_vaccination->lot_number == '' ? 'No especificada' : $person_vaccination->lot_number }}
                    </td>
                    <td>
                        {{ $person_vaccination->is_vaccinated == 1 ? 'Si' : 'No' }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <script src="{{ asset('scripts/vendors/polyfill.js') }}"></script>
    <script src="{{ asset('scripts/vendors/html2canvas.min.js') }}"></script>
    <script src="{{ asset('scripts/vendors/jspdf.umd.min.js') }}"></script>
    <script src="{{ asset('scripts/js/all-person-vaccinations/printVaccinations.js') }}"></script>
</div>
