<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9 ]>    <html lang="hr" class="no-js lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="hr" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>IA :: Demo</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="internet, app">
    <meta name="description" content="internet app">
    <meta name="author" content="Matija Buriša">
    <meta property="og:title" content="Internet aplikacija" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ Request::url('/') }}" />
    <meta property="og:site_name" content="Internet.aplikacija" />
    <meta property="og:description" content="Internet aplikacija :: Matija Buriša" />

    <!-- scripts -->
    {{ HTML::script('js/jquery.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/modernizr.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/jquery.responsive-tables.js', ['charset' => 'utf-8']) }}
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/respond.js', ['charset' => 'utf-8']) }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/main.css') }}
</head>
<body>
<!-- notifications -->
<div class="notificationOutput" id="outputMsg">
    <div class="notificationTools" id="notifTool">
        <span class="fa fa-times fa-med" id="notificationRemove"></span>
        <span id="notificationTimer"></span>
    </div>
</div>

    <!-- navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Navigacija</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">IA :: Demo</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav">
                    {{ HTML::smartRoute_link('/', 'Početna', '') }}
                    {{ HTML::smartRoute_link('show-users/', 'Lista korisnika', '') }}
                    {{ HTML::smartRoute_link('add-user', 'Ručno dodavanje korisnika', '&#x2b;') }}
                    {{ HTML::smartRoute_link('add-users/250', 'Dodaj 250 korisnika', '&#x2b;') }}
                    {{ HTML::smartRoute_link('add-users/1000', 'Dodaj 1000 korisnika', '&#x2b;') }}
                    {{ HTML::smartRoute_link('delete-users', 'Obriši korisnike', '&#x2212;') }}
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <a href="#" id="back-to-top" title="Povratak na vrh">&uarr;</a>

    <!-- Page Content -->
    <div class="container-fluid" id="main-section">
        <div class="row">
            <div class="col-md-12 text-center">
