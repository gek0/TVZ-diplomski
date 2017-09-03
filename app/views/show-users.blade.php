@include('layout.header')


<h1>Prikaz korisnika</h1><hr>

<h3>Ukupno postoji <strong>{{ $number_of_users }}</strong> korisnika i prikazano je <strong>{{ $number_fetched }}</strong>.</h3>
<h3>Skripta se izvodila: <strong>{{ $time_calculations }}</strong> sek.</h3>
<h3 id="time-loader-holder">Stranica se učitala za: <strong><span id="time-loader"></span></strong> sek.</h3>

<section id="content-output">
    <div class="table-responsive">
        <table class="table container-table" id="responsive-data-table">
            <thead>
                <tr>
                    <td>Avatar</td>
                    <td>Ime</td>
                    <td>Prezime</td>
                    <td>Korisničko ime</td>
                    <td>E-mail adresa</td>
                    <td>Ime fakulteta/učilišta</td>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <div class="grid">
                            <figure class="effect-goliath">
                                <img src='{{ $user['avatar'] }}' class="img-responsive" />
                                <figcaption>
                                    <p>{{ $user['first_name'] }} {{ $user['last_name'] }}</p>
                                </figcaption>
                            </figure>
                        </div>
                    </td>
                    <td>{{ $user['first_name'] }}</td>
                    <td>{{ $user['last_name'] }}</td>
                    <td>{{ $user['username'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['university_name'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>


@include('layout.footer')