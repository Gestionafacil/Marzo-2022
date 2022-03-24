<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
        integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/alertifyjs/css/normalize.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/alertifyjs/css/alegra.min.css') }}" type="text/css">
    <link href="{{ asset('css/alertifyjs/css/app.080f9e83.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/media/logos/LOGO-PNG-SOLO.png') }}">
    <link rel="stylesheet" href="{{ asset('css/EstiloLogin.css') }}" />

    <title>Inicio de Sesión - Gestiona Facil Software Contable</title>
    <style>
        .alert{
            padding: 10px;
            border-radius: 3px;
        }
        .alert-danger{
            background: #ff000085;
            color: #b31d1d;
        }

        .alert-success{
            background: #82de5c85;
            color: #1db32f;
        }
        }
    </style>
</head>

<body>
    <div id="hs-feedback-fetcher"></div>
    <noscript>
        <iframe width=0 height=0 style=display:none;visibility:hidden src="https://www.googletagmanager.com/ns.html?id=GTM-KQG46G"></iframe>
    </noscript>
    <noscript>
        <strong>Esta aplicación no funciona correctamente sin JavaScript. Por favor habilite JavaScript para continuar.</strong>
    </noscript>
    <div class="layout-01">
        <aside data-v-6357c280="" class="sidebar-large">
            <div data-v-6357c280="" class="user-access">
                <div data-v-6357c280="" class="user-access-header">
                    <a data-v-6357c280="" href="{{ route('Bienvenido', []) }}">
                        <img src="{{ asset('img/GESTIONA-FACIL-PNG.png') }}" width="170" height="118" data-v-6357c280="">
                    </a>
                    <p data-v-6357c280="" class="is-large is-text-grey6">Ingresa a tu cuenta</p>
                    <p data-v-6357c280="" class="is-text-brand1">Sigue ganando tiempo y tranquilidad</p>
                </div>
                <div data-v-6357c280="" class="user-access-form">
                    <!-- Formulario de ingreso -->
                    <form method="POST" id="formLogin" method="POST" action="{{ route('AutenticarUsuario', []) }}" autocomplete="off">
                        @include('layouts.alerts')
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div data-v-1ff62b05="" data-v-dd2603de="">
                            <div data-v-1ff62b05="" class="input-wrapper">
                                <input placeholder="Correo Electronico" id="email" name="email" type="email"
                                    class="is-full-width is-large is-text-grey7"
                                    value="{{ old('email') }}">
                            </div>
                        </div>
                        <div data-v-1ff62b05="" data-v-dd2603de="">
                            <div data-v-1ff62b05="" class="input-wrapper is-relative">
                                <input type="password" name="password" placeholder="Contraseña" id="password"
                                    class="is-full-width is-large is-text-grey7" data-toggle="password"
                                    value="{{ old('password') }}">
                                <span class="input-group-text"><i class="fa fa-eye"> MOSTRAR CONTRASEÑA</i></span>
                            </div>
                        </div>
                        <button type="submit" class="enviar button is-primary is-full-width is-large">INGRESAR</button>
                    </form>
                </div>
                <div data-v-0f8bd4aa="" data-v-6357c280="" class="user-access-footer">
                    <p data-v-0f8bd4aa="" class="is-small"><a data-v-0f8bd4aa="" href="restaurar"
                            class="is-text-brand1">¿Olvidaste tu contraseña?</a></p>
                    <hr data-v-0f8bd4aa="">
                    <p data-v-0f8bd4aa="" class="is-text-grey6 is-regular">
                        ¿Aún no tienes una cuenta?
                        <a data-v-0f8bd4aa="" href="{{ route('Registrar', []) }}" class="is-text-brand1"><b>CREA UNA CUENTA</b></a>
                    </p>
                </div>
                <!-- <button type="button" id="prueba"> prueba</button> -->
            </div>
        </aside>
        <section data-v-64e09036="" class="content is-text-white">
            <div data-v-64e09036="">
                <div data-v-64e09036="" class="grid slide"
                    style="background: url(&quot;https://i.ibb.co/k1vKRv3/fondo-login.png&quot;) center center / cover no-repeat;">
                    <div data-v-64e09036="" class="help-call">
                        <p data-v-64e09036="">Para ayuda escríbenos en</p><a data-v-64e09036="" href="../Contacto.html"
                            target="_blank" class="button is-outline is-small is-pill">GESTIONAFACIL</a>
                    </div>
                    <div data-v-64e09036="" class="grid jumbotron">
                        <div class="container">
                            <h2 class="carrousel-slide-title">Facturación Electrónica</h2>
                            <p class="carrousel-slide-paragraphe">Crea facturas fácil y rápido desde y en cualquier momento.</p>
                            <a target="_blank" href="#" class="button is-pill"><b class="is-text-brand1">VER MÁS</b></a>
                        </div>
                        <div class="container"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-show-password.js') }}"></script>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);
        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
                '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();

    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>
