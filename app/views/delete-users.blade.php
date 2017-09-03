@include('layout.header')


<h1>Brisanje korisnika</h1><hr>

<h3>Obrisano je <strong>{{ $number_of_deleted }}</strong> korisnika.</h3>
<h3>Skripta se izvodila: <strong>{{ $time_calculations }}</strong> sek.</h3>
<h3 id="time-loader-holder">Stranica se učitala za: <strong><span id="time-loader"></span></strong> sek.</h3>


@include('layout.footer')