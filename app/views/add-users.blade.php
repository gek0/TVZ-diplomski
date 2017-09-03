@include('layout.header')


<h1>Dodavanje korisnika</h1><hr>

<h3>Dodano je <strong>{{ $number_of_seeds }}</strong> korisnika.</h3>
<h3>Skripta se izvodila: <strong>{{ $time_calculations }}</strong> sek.</h3>
<h3 id="time-loader-holder">Stranica se učitala za: <strong><span id="time-loader"></span></strong> sek.</h3>

<section id="content-output">
    <div class="table-responsive">
        <table class="table container-table no-image-" id="responsive-data-table">
            <thead>
                <tr>
                    <td>Avatar</td>
                    <td>Ime</td>
                    <td>Prezime</td>
                    <td>Korisničko ime</td>
                    <td>E-mail adresa</td>
                    <td>Ime fakulteta/učilište</td>
                </tr>
            </thead>
            <tbody>
            @foreach($seeds_storage as $seed)
                <tr>
                    <td>
                        <div class="grid">
                            <figure class="effect-goliath">
                                <img src='{{ $seed['avatar'] }}' class="img-responsive" />
                                <figcaption>
                                    <p>{{ $seed['first_name'] }} {{ $seed['last_name'] }}</p>
                                </figcaption>
                            </figure>
                        </div>
                    </td>
                    <td>{{ $seed['first_name'] }}</td>
                    <td>{{ $seed['last_name'] }}</td>
                    <td>{{ $seed['username'] }}</td>
                    <td>{{ $seed['email'] }}</td>
                    <td>{{ $universities[$seed['university_id'] - 1]->university }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>


@include('layout.footer')