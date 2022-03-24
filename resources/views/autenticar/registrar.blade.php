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
    <link rel="stylesheet" href="{{ asset('css/EstiloLogin.css') }}" />
    <link rel="icon" href="{{ asset('img/media/logos/LOGO-PNG-SOLO.png') }}">
    <title>Crear Cuenta - Gestiona Facil Software Contable</title>
</head>

<body>
    <div id="hs-feedback-fetcher"></div>
    <noscript>
        <iframe width=0 height=0 style=display:none;visibility:hidden
            src="https://www.googletagmanager.com/ns.html?id=GTM-KQG46G"></iframe>
    </noscript>
    <noscript>
        <strong>Esta aplicación no funciona correctamente sin JavaScript. Por favor habilite JavaScript para
            continuar.</strong>
    </noscript>
    <div class="layout-01">
        <aside data-v-6357c280="" class="sidebar-large">
            <div data-v-6357c280="" class="user-access">
                <div data-v-6357c280="" class="user-access-header"><img
                        src="{{ asset('img/GESTIONA-FACIL-PNG.png') }}" width="170" height="118" data-v-6357c280="">
                    <p data-v-6357c280="" class="is-large is-text-grey6">¡Crea tu cuenta gratis!
                    </p>
                    <p data-v-6357c280="" class="is-text-brand1">Prueba todas las funciones durante 15</p>
                </div>
                <div data-v-6357c280="" class="user-access-form">
                    <!-- Formulario de registro -->
                    <form method="POST" id="formRegistro" action="{{ route('UsuarioCrear', []) }}" autocomplete="off">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {{ \Session::get('success') }}
                            </div>
                        @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="rol" value="1">
                        <div data-v-1ff62b05="" data-v-dd2603de="">
                            <div data-v-1ff62b05="" class="input-wrapper">
                                <input placeholder="Correo Electronico" id="email" type="email" name="email"
                                    class="is-full-width is-large is-text-grey7" required value="{{ old('email') }}">
                            </div>
                        </div>
                        <div data-v-1ff62b05="" data-v-dd2603de="">
                            <div data-v-1ff62b05="" class="input-wrapper is-relative">
                                <input type="password" name="password" placeholder="Asigna tu clave" id="password"
                                    class="is-full-width is-large is-text-grey7" data-toggle="password" value="{{ old('password') }}">
                                <span class="input-group-text"><i class="fa fa-eye"> MOSTRAR CONTRASEÑA</i></span>
                            </div>
                        </div>
                        <button type="submit" class="enviar button is-primary is-full-width is-large">CREAR
                            CUENTA</button>
                    </form>
                </div>
                <p data-v-b6f0b154="" class="is-small">&nbsp;
                </p>
                <p data-v-b6f0b154="" class="is-small">Al crear tu cuenta aceptas nuestras<a data-v-b6f0b154="" href="#"
                        target="_blank" class="is-text-brand1"> Tratamiento de Datos</a>.
                </p>
                <div data-v-101076f9="" class="user-access-footer">
                    <hr data-v-101076f9="">
                    <p data-v-101076f9="" class="is-text-grey6 is-regular">
                        ¿Ya tienes una cuenta?
                        <a data-v-101076f9="" href="{{ route('login', []) }}"
                            class="is-text-brand1"><b>INGRESAR</b></a>
                    </p>
                </div>
                <div data-v-0f8bd4aa="" data-v-6357c280="" class="user-access-footer"></div>
            </div>
            <section data-v-64e09036="" class="content is-text-white">
                <div data-v-64e09036="">
                    <div data-v-64e09036="" class="grid slide"
                        style="background: url(&quot;https://i.ibb.co/C7fXJ8B/fondo-registro.png&quot;) center center / cover no-repeat;">
                        <div data-v-64e09036="" class="help-call">
                            <p data-v-64e09036="">Para ayuda escríbenos en</p><a data-v-64e09036=""
                                href="../Contacto.html" target="_blank"
                                class="button is-outline is-small is-pill">GESTIONAFACIL</a>
                        </div>
                        <div data-v-48418dfb="" data-v-64e09036="" class="grid jumbotron">
                            <div data-v-48418dfb="" class="container">
                                <h2 data-v-48418dfb="" class="carrousel-slide-title">Crea tu Cuenta</h2>
                                <p data-v-48418dfb="" class="carrousel-slide-paragraphe">Tambien recuerda que puedes
                                    suspender tu plan en cualquier momento, donde y cuando quieras.</p><a
                                    data-v-48418dfb="" target="_blank" href="#" class="button is-pill"><b
                                        data-v-48418dfb="" class="is-text-brand1">VER MÁS</b></a>
                            </div>
                            <div data-v-48418dfb="" class="container"></div>
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
