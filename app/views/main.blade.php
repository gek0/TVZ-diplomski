@include('layout.header')

<h1>Početna</h1>
<h3 id="time-loader-holder">Stranica se učitala za: <strong><span id="time-loader"></span></strong> sek.</h3>

<section id="content-output">
    <div class="well">
        <p>Ova internet aplikacija je ostavljena neoptimizirana na strani klijenta i strani poslužitelja.</p><br>

        <p>PHP kod je pisan bez posebne pažnje posvećene performansama aplikacije već tomu da aplikacija radi ono za što je namijenjena.</p><br>

        <p>Skripta kao rezultat daje otprilike 4x (četiri) puta manje performanse od optimizirane aplikacije.</p><br>

        <p>Vrijeme potrebno da se kreira 1000 korisnika s generatorom podataka te njihove potrebne atribute premašuje realno i dopušteno vrijeme na poslužitelju za izvršavanje i uslijed toga poslužitelj ubija proces.</p><br>

        <p>Moguće je kreirati 250 korisnika s pripadajućim atributima i to traje skoro isto vrijeme u koje optimizirana aplikacija kreira 1000 korisnika.</p><br>

        <p>S izostankom paginacije, lista korisnika dohvaća sve dostupne entitete iz baze i zahtjeva veće računalne resurse na strani poslužitelja, ali i klijenta.</p><br>
    </div>
</section>

@include('layout.footer')