@include('layout.header')


<h1>Dodavanje korisnika</h1><hr>

<h3>Skripta se izvodila: <strong>{{ $time_calculations }}</strong> sek.</h3>
<h3 id="time-loader-holder">Stranica se učitala za: <strong><span id="time-loader"></span></strong> sek.</h3>

<section id="content-output">
    <section class="section form-section">
        {{ Form::open(['url' => 'add-user', 'role' => 'form', 'id' => 'new-user']) }}
        <div class="row text-center">
            <div class="col-md-6 col-md-offset-3">
                @if(isset($errors_list))
                    <div id="error-box">
                        @foreach($errors_list as $err)
                            @foreach($err as $e)
                                <p>{{ $e }}</p>
                            @endforeach
                        @endforeach
                    </div>
                @endif
                @if(isset($success_list))
                    <div id="success-box">
                        <p>{{ $success_list }}</p>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('first_name', 'Ime korisnika:') }}
                    {{ Form::text('first_name', null, ['class' => 'form-input-control', 'placeholder' => 'Ime korisnika', 'id' => 'first_name', 'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('last_name', 'Prezime korisnika:') }}
                    {{ Form::text('last_name', null, ['class' => 'form-input-control', 'placeholder' => 'Prezime korisnika', 'id' => 'last_name', 'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('username', 'Korisničko ime:') }}
                    {{ Form::text('username', null, ['class' => 'form-input-control', 'placeholder' => 'Korisničko ime', 'id' => 'username', 'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('email', 'E-mail adresa:') }}
                    {{ Form::email('email', null, ['class' => 'form-input-control', 'placeholder' => 'E-mail adresa', 'id' => 'email', 'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('password', 'Lozinka:') }}
                    {{ Form::text('password', null, ['class' => 'form-input-control', 'placeholder' => 'Lozinka', 'id' => 'password', 'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('password_again', 'Lozinka ponovo:') }}
                    {{ Form::text('password_again', null, ['class' => 'form-input-control', 'placeholder' => 'Lozinka ponovo', 'id' => 'password_again', 'required']) }}
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    {{ Form::label('user_university', 'Ime fakulteta/učilišta:') }}<br>
                    {{ Form::select('user_university', ['Izaberi fakultet/učilište...' => $user_universities],
                                              null, ['class' => 'form-input-control', 'data-size' => '5'])
                    }}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit btn-padded" id="userSubmit">Dodaj korisnika &#x2b;</button>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->
        {{ Form::close() }}
    </section>
</section>


@include('layout.footer')