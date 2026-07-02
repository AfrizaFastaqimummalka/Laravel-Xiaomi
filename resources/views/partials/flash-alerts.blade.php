{{--
    Partial untuk menampilkan flash alert dari session Laravel (success & error).

    Markup ini sama di layout app dan admin, jadi dipisah ke sini biar tidak duplikat.
    Atribut data-flash="true" dipake sama flash-alert.js untuk auto-dismiss setelah 4 detik.

    Cara pakai: @include('partials.flash-alerts')
--}}

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show"
         role="alert"
         data-flash="true">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show"
         role="alert"
         data-flash="true">
        <i class="bi bi-exclamation-triangle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
@endif
