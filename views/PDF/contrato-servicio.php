<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato Servicio de <?= $contrato->usuario->user . ' ' . $contrato->usuario->lastname ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Outfit", sans-serif;
        }

        .marca-agua {
            position: fixed;
            z-index: -1;
            width: 100%;
            height: 1055px;
            top: 0;
            left: 0;
        }

        .contenedor {
            text-transform: uppercase;
            margin: 0 auto;
            width: 100%;
            max-width: 40rem;
        }

        [class$="__negritas"] {
            font-weight: 700;
        }

        [class$="__subrayadas"] {
            text-decoration: underline;
            font-weight: 700;
        }

        [class$="__texto"] {
            font-size: 0.8rem;
            text-align: justify;
        }

        .guiones-extras {
            font-size: 0.9rem;
            font-weight: 400;
        }

        .header {
            margin-top: 7rem;
            margin-bottom: 1rem;
        }

        .header__titulo {
            text-align: center;
            font-size: 1rem;
            color: #0092b8;
        }

        .section-encabezado {
            height: 12rem;
            overflow: hidden;
        }

        .section-clausulas {
            height: 15rem;
            overflow: hidden;
        }

        .section-clausulas__header {
            text-align: justify;
            width: 100%;
        }

        .section-clausulas-estaticas__contenedor-2 {
            margin-top: 8rem;
            padding-top: 7rem;
        }

        .section-fecha {
            height: 10rem;
            overflow: hidden;
        }

        .section-fecha__texto {
            font-weight: 700;
        }

        .section-firmas__table {
            width: 100%;
            border-collapse: collapse;
        }

        .section-firmas__row {
            text-align: center;
            font-size: 0.8rem;
        }

        .section-firmas__empresa {
            width: 200px;
            font-size: 0.8rem;
            text-align: center;
        }

        .section-firmas__usuario {
            width: 200px;
            font-size: 0.8rem;
            text-align: center;
        }

        .carta-compromiso {
            margin-top: 5rem;
        }

        .carta-compromiso__titulo {
            text-align: center;
            font-size: 1.5rem;
        }

        .carta-compromiso__fecha {
            margin-bottom: 1rem;
            margin-left: 20rem;
            font-size: 0.8rem;
        }

        .carta-compromiso__contenido {
            font-size: 0.8rem;
            text-align: justify;
        }

        .carta-compromiso__listado {
            margin-left: 2rem;
        }

        .carta-compromiso__advertencia {
            margin-top: 1rem;
        }

        .carta-compromiso__subtitulo {
            margin-top: 1rem;
        }

        .carta-compromiso__footer {
            margin-top: 1rem;
        }

        .carta-compromiso__firma {
            margin-top: 1rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <img src="<?= $imagen ?>" alt="initial" class="marca-agua">
    <main class="contenedor">
        <header class="header">
            <h1 class="header__titulo">Contrato de servicio de agua potable y/o drenaje <?= $contrato->folio ?></h1>
        </header>

        <section class="section-encabezado">
            <div class="section-encabezado__contenedor">
                <p class="section-encabezado__texto">
                    contrato de prestación de servicios de agua potable que celebran por una parte
                    <span class="section-encabezado__negritas">el sistema operador de agua potable y alcantarillado del municipio de zacapoaxtla</span>
                    , representado en este acto por su director general el
                    <span class="section-encabezado__negritas">ing. juan bernardo amador gonzález</span>
                    y por la otra parte el / la
                    <span class="section-encabezado__subrayadas">C. <?= $contrato->usuario->user . " " .  $contrato->usuario->lastname ?></span>
                    que en lo sucesivo se denominaran sistema operador y usuario respectivamente el presente contrato se sujetará a las siguientes:
                    <span class="guiones-extras">
                        - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                    </span>
                </p>
            </div>
        </section>

        <section class="section-clausulas">
            <header class="section-clausulas__header">
                - - - - - - - - - - - - - - - - - - - - - - - - - - <span class="section-clausulas__negritas">Cláusulas</span> - - - - - - - - - - - - - - - - - - - - - - - - -
            </header>
            <p class="guiones-extras">
                -- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            </p>
            <div class="section-clausulas__contenedor">
                <p class="section-clausulas__texto">
                    <span class="section-clausulas__negritas">primera:</span> el servicio del agua potable será de tipo:
                    <span class="section-clausulas__negritas"><?= $contrato->usuario->id_intaketype->name . " " . $contrato->usuario->id_consumtype->name . " " . $contrato->usuario->id_servicetype->name ?> </span>
                    con id usuario asignado
                    <span class="section-clausulas__negritas"><?= $contrato->id_user; ?></span>
                    y será conectado en
                    <span class="section-clausulas__negritas"><?= $contrato->usuario->address . " , zacapoaxtla, puebla."; ?></span>
                    donde el sistema operador se compromete a proporcionar el servicio de agua potable a nivel de banqueta, salvo en causas de mantenimiento, reparación, siniestro, inclemencias del tiempo, falta de lluvia (estiaje).
                    <span class="guiones-extras">
                        - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                    </span>
                </p>
            </div>
        </section>
        <section class="section-clausulas-estaticas">
            <div class="section-clausulas-estaticas__contenedor">
                <p class="section-clausulas-estaticas__texto">
                    <span class="section-clausulas-estaticas__negritas">segunda:</span> la responsabilidad del sistema operador será precisamente hasta el punto de entrega del agua potable en la caja para válvulas o en el cuadro donde sera conectado el medidor, en su oportunidad, con la observación que después del punto de entrega al interior de su propiedad por ser parte que pertenece al usuario, sera exclusivamente responsabilidad del mismo. - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                </p>
                <p class="section-clausulas-estaticas__texto">
                    <span class="section-clausulas-estaticas__negritas">tercera:</span> el sistema operador efectuará las reparaciones en tomas domiciliarias, líneas de conducción y redes de distribución, procurando que estas se realicen en el menor tiempo posible. - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                </p>
                <p class="section-clausulas-estaticas__texto">
                    <span class="section-clausulas-estaticas__negritas">cuarta:</span> el sistema operador tendrá derecho en todo tiempo para suspender temporalmente el servicio, para hacer las reparaciones o para cualquier otro objeto indispensable al servicio en general, procurando que estas se realicen en el menor tiempo posible, en caso de mantenimiento, el sistema operador notificará en su oportunidad. - - - -
                </p>
                <p class="section-clausulas-estaticas__texto">
                    <span class="section-clausulas-estaticas__negritas">quinta:</span> el usuario pagará en los primeros siete días de cada mes los servicios que reciba, conforme a la tarifa autorizada en vigor de las cuotas, tasas y tarifas de los servicios que presta el sistema operador. - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                </p>
                <p class="section-clausulas-estaticas__texto">
                    <span class="section-clausulas-estaticas__negritas">sexta:</span> la falta de pago motivará el cobro de notificaciones, actualización y recargos, así como la reducción del servicio, de acuerdo con lo establecido en la ley de agua y saneamiento del estado de puebla en sus articulo 99 y 119. -- - - - - - - - - - - - - - - - - - - - - - - - - - -
                </p>
            </div>
            <div class="section-clausulas-estaticas__contenedor-2">
                <p class="section-clausulas-estaticas__texto">
                    <span class="section-clausulas-estaticas__negritas">septima:</span> el usuario deberá tener en su instalación depósitos de almacenamiento, cisterna, tinaco con su flotador bien calibrado o en su defecto contar con fuente o pileta construida suficientes para el uso previamente autorizado. - - - - - - - - - - - - - - - - - - - - - - - - -
                </p>
                <p class="section-clausulas-estaticas__texto">
                    <span class="section-clausulas-estaticas__negritas">octava:</span> el usuario se obliga a permitir que el personal autorizado por el sistema operador pueda efectuar la inspeccion a la instalacion hidraulica asi como la sanitaria, reparaciones necesarias y la lectura correspondiente del medidor si es el caso. - - - - - - - -
                </p>
                <p class="section-clausulas-estaticas__texto">
                    <span class="section-clausulas-estaticas__negritas">novena:</span> el usuario se da por enterado y reconoce que no podrá permitir ni conceder derivaciones de las instalaciones del servicio del agua que reciba a otro u otros edificios, predios, giros o establecimientos, si lo permite se hará acreedor a las sanciones que establezca el sistema operador. -- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                </p>
                <p class="section-clausulas-estaticas__texto">
                    <span class="section-clausulas-estaticas__negritas">decima:</span> el usuario podrá dar por terminado este contrato, previo aviso por escrito por lo menos con diez días de anticipación. el hecho de que el usuario de por terminado este contrato no lo exime de las obligaciones económicas que hubiera contraído con motivo del mismo. -- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                </p>
                <p class="section-clausulas-estaticas__texto">
                    <span class="section-clausulas-estaticas__negritas">úndecima:</span> el usuario tiene la obligación de comunicar al sistema operador, de la baja o suspensión temporal de la toma de agua ya que de lo contrario el sistema operador al no tener conocimiento de ello seguirá cobrando el servicio normalmente. -- - - - - - - - - - - - - -
                </p>
                <p class="section-clausulas-estaticas__texto">
                    <span class="section-clausulas-estaticas__negritas">duodécima:</span> lo no previsto en este contrato se regirá por la ley de agua y saneamiento del estado de puebla, las normas de la secretaria de salud en materia de agua y saneamiento, la ley de aguas nacionales y su reglamento, el decreto de creación del sistema operador, las tarifas autorizadas y demás relativos. -- - - - - - - - - - - - - - - - - - - - - - -
                </p>
            </div>
        </section>
        <section class="section-fecha">
            <div class="section-fecha__contenedor">
                <?php $fecha_numero = (int)date('d', strtotime($contrato->fecha))?>
                <p class="section-fecha__texto">
                    
                    enteradas las partes del contenido de cada una de las cláusulas de este contrato, están de acuerdo en celebrarlo, no existiendo ningún vicio de la voluntad o del consentimiento que pudiera invalidarlo, lo firman a los <span class="section-fecha__subrayadas"><?= numeroALetras($fecha_numero); ?> dias, del mes de <?= formatearFechaES($contrato->fecha); ?> </span>, en las oficinas de la direccion general en calle la concordia numero doce, colonia centro, zacapoaxtla, puebla.
                    <span class="guiones-extras">
                        - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                    </span>
                </p>
            </div>
        </section>
        <section class="section-firmas">
            <table class="section-firmas__table">
                <thead></thead>
                <tbody>
                    <tr class="section-firmas__row">
                        <td class="section-firmas__empresa">
                            <p>
                                POR EL SISTEMA OPERADOR DE AGUA POTABLE Y ALCANTARILLADO DEL MUNICIPIO DE ZACAPOAXTLA.
                            </p>
                            <p>
                                <span class="section-firmas__negritas">SOMAPAZ</span>, no la Produce, Solo la Conduce “Por un Dulce Futuro, ¡Cuidemos el Agua!
                            </p>
                        </td>
                        <td class="section-firmas__usuario">
                            Por el Usuario
                        </td>
                    </tr>
                    <tr class="section-firmas__row">
                        <td>
                            <br>
                            <br>
                            <br>
                            ______________________________________
                        </td>
                        <td>
                            <br>
                            <br>
                            <br>
                            ______________________________________
                        </td>
                    </tr>
                    <tr class="section-firmas__row">
                        <td>
                            Ing. Juan bernardo amador gonzalez
                            director general
                        </td>
                        <td>
                            C. <?= $contrato->usuario->user . " " .  $contrato->usuario->lastname ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
    <div style="page-break-after:always;"></div>
    <section class="contenedor carta-compromiso">
        <header>
            <h2 class="carta-compromiso__titulo">Carta de Compromiso</h2>
            <p class="carta-compromiso__fecha">Zacapoaxtla, Puebla a <span class="carta-compromiso__subrayadas"><?= formatearFechaESLong($contrato->fecha); ?></span></p>
        </header>
        <main class="carta-compromiso__contenido">
            <p>
                En el <span class="carta-compromiso__subrayadas">SOMAPAZ</span> estamos conscientes de las medidas salubres que se requieren en cada domicilio y/o negocio, así como la importancia de mantener limpias las áreas, sin embargo, solicitamos que se tome en cuenta lo siguiente:
            </p>
            <ol class="carta-compromiso__listado">
                <li>Evitar a toda costa el uso de manguera o compresora.</li>
                <li>Evita lavar patios o banquetas, hazlo solo en caso de ser muy necesario, utilizando una cubeta de 5 litros de agua reciclada para tallar y otra cubeta de la misma medida de agua limpia para enjuagar.</li>
                <li>En caso de fuga de agua o goteo, repara de forma inmediata.</li>
                <li>Evita a toda costa que se derrame agua de los depósitos o de las llaves con las que cuentes en casa.</li>
            </ol>
            <p>Cualquier acción contraria a las medidas antes mencionadas será considerada <span class="carta-compromiso__subrayadas">desperdicio de agua</span> y se aplicará la siguiente multa:</p>
            <p class="carta-compromiso__advertencia">
                Por concepto de sanción por desperdicio de agua, aún en tomas con medidor se cobrará como mínimo 12 veces la unidad de medida <span class="carta-compromiso__subrayadas">- $1,244.88 -</span> y actualización y como máximo 22 veces la unidad de medida y actualización vigentes y la clausura del servicio; en el caso de reincidir o de reconectar la toma sin autorización de este Organismo Operador, el monto de la sanción se incrementará de acuerdo con el número de veces que se reincida.
            </p>
            <p>
                *Art. 14 Fracc. V del Acuerdo de cuotas, tasas y tarifas vigentes al 2024 publicado en el
                Periódico Oficial del Gobierno del Estado de Puebla.
            </p>

            <p class="carta-compromiso__negritas">Reporta fugas y desperdicio al 233 108 5581.</p>

            <h3 class="carta-compromiso__subtitulo">Cuida el Agua</h3>

            <p>
                Estamos ante una situación de escasez de agua crítica en la región y en el país, aunado a una creciente población que requiere el servicio vital para sus necesidades básicas. Es responsabilidad del usuario contar con el almacenamiento que considere necesario y suficiente para cubrir las necesidades y actividades diarias de su familia, teniendo en cuenta que distintas situaciones que se susciten a lo largo del año pueden provocar intermitencias sin agua de aproximadamente 3 días.
            </p>
            <p class="carta-compromiso__footer">
                Mantente informado por medios oficiales: Facebook “SOMAPAZ Oficial”, al Tel. <span class="carta-compromiso__subrayadas">233 314 3148</span> o al Cel. <span class="carta-compromiso__subrayadas">233 108 5581</span>.
            </p>
            <div class="carta-compromiso__firma">
                <p class="carta-compromiso__negritas">Firma de enterado y conformidad</p>
                <br>
                <br>
                <br>
                <p>--------------------------------</p>
                <p class="carta-compromiso__negritas">C. <?= $contrato->usuario->user . " " .  $contrato->usuario->lastname ?></p>
            </div>
        </main>
    </section>
</body>

</html>