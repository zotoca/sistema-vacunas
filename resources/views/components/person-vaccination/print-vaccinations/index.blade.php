<div>
    <link rel="stylesheet" href="{{ asset('styles/fonts/fonts.lato.google.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/fonts/fonts.archivoblack.google.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/printVaccinations.css') }}">

    <div class="container" id="document">
        <div id="ignorePDF">
            <button id="print">Imprimir documento</button>
        </div>

        <h2 class="title">Sistema de Vacunas Morichal</h2>

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

        @foreach ($person_vaccinations as $person_vaccination)
            <p>
                {{ $person_vaccination->vaccination->name }}
            </p>
        @endforeach
    </div>

    <script src="{{ asset('scripts/vendors/polyfill.js') }}"></script>
    <script src="{{ asset('scripts/vendors/html2canvas.min.js') }}"></script>
    <script src="{{ asset('scripts/vendors/jspdf.umd.min.js') }}"></script>
    <script src="{{ asset('scripts/js/all-person-vaccinations/printVaccinations.js') }}"></script>
</div>
