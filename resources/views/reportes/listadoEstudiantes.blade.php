<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LISTADO DE CURSO {{$curso->curso_sigla}} "{{$curso->paralelo}}"</title>
    <!-- CSS only -->
    <style>
        @page{
            /*margin: 0rem;
            margin-top:0rem;
            padding: 1rem;*/
            margin: 0cm 0cm;
        }
        body {
            /*margin: 0px;*/
            margin-top: 4cm;
            margin-bottom: 2cm;
            /** margenes de izquierda y derecha es menos un cm*/
            margin-left: 3cm;
            margin-right: 2cm;
            /* border: 1px solid #C00; */
        }
        header {
            position: fixed;
            top: 0cm;
            left: 3cm;
            right:2cm;
            height: 4cm;
            /*background-color: #3498DB;*/
            color: black;
            text-align: right;
            /*line-height: 10px;*/
            /*font-size: 9px;*/
            /* border: 1px solid #C00; */
            padding-top: 5px;
            padding-bottom: 0px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 3cm;
            right: 2cm;
            height: 2cm;
            /*background-color: #3498DB;*/
            color: black;
            /*text-align: right;*/
            line-height: 24px;
            /*font-size: 9px;
            border: 1px solid #C00;*/
        }

        /*#footer .page:after { content: counter(page, upper-roman);}*/

        * {
            font-family: verdana, arial, sans-serif;
        }

    </style>
</head>
<body>

<header>        
    <div style="padding-top: 1cm; padding-bottom: 1px;">
        <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/margin-bottom: 0px; " class="table table-bordered table-striped">
            <tbody class="table-striped">
                <tr>
                    <td width="20%" style="/*border: 1px solid #000;*/ padding: 0px; font-size: 10px; text-align: center;">
                        <span><img style="width:3cm; height:3cm; /*border: 2px solid #142A98;*/" src="../public/img/colegio/bolivia_escudo.png"></span>
                    </td>

                    <td width="60%" style="/*border: 1px solid #000;*/ padding: 0px; font-weight: bold; text-align: center; vertical-align: middle;">
                        <div style="text-align: center; /*width: 230px;*/ /*border: 1px solid #C00;*/">
                            <p style="margin: 1px; font-size: 14pt;">{{$colegio->col_nombre}}</p>
                            <p style="margin: 1px; font-size: 10pt;">COD. SIE. {{$colegio->col_sie}}</p>
                            <p style="margin: 1px; font-size: 10pt;">GESTIÓN 2022</p>
                        </div>
                    </td>
                    <td width="20%" style="/*border: 1px solid #000;*/ padding: 0px; font-size: 10px; text-align: center;">
                        <span><img style="width:3cm; height:3cm; /*border: 2px solid #142A98;*/" src="../public/img/colegio/{{$colegio->col_foto}}"></span>
                    </td>
                   
                </tr>  
            </tbody>
        </table>
    </div>
</header> 

<footer>
    <div>
        <table width="100%" style="border-collapse: collapse; /*border-bottom: 1px solid #000000;*/
            border-spacing: 0; 
             border-bottom: 1px; 
            margin-bottom: 5px;" class="table table-bordered table-striped">
            <tbody class="table-striped">
                <tr>
                    <td style="/*border: 1px solid #000;*/ padding-top: 25px; padding-bottom: 25px; font-size: 10px; text-align: left; font-weight: bold;">
                        <span>Fecha de Emision: 
                            <?php
                                $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
                                $fecha = date('dHi')."-".$meses[date('n')-1]."-".date('Y');
                                echo $fecha;
                            ?>
                        </span>
                    </td>
                    <td style="/*border: 1px solid #000;*/ padding: 2px; font-size: 10px; text-align: right; font-weight: bold;">
                        <span>Desarrollado por : SYSTEM ALBERT - 
                            <?php
                                $gestion_act = date("Y");
                                echo $gestion_act;
                             ?>
                        </span>
                    </td>
                </tr>  
            </tbody>
        </table>
    </div>
</footer>

    <main>  
    
        <div class="cabecera">
        <!--border: 1px solid #C00;-->
                <!--<div style="text-align: center; width: 230px; font-size: 11.5px; margin-top: 0cm;/*border: 1px solid #C00;*/">
                    <p style="margin: 0px">FUERZA AÉREA BOLIVIANA</p>
                    <p style="margin: 0px 0px">DEPARTAMENTO I - PERSONAL EMGFAB</p>
                    <p style="margin: 0px 0px;"><u><strong>BOLIVIA</strong></u></p>
                </div>-->

                
                
                <div style="padding-top: 1cm; padding-bottom: 0.5cm; text-align: center; font-weight: bold; /*border: 1px solid #C00;*/">
                    <p style="margin: 1px; font-size: 15pt;">LISTA DE ESTUDIANTES</p>
                </div>

                <div style="padding-top: 0.5cm; padding-bottom: 0.5cm; text-align: left; font-weight: bold; /*border: 1px solid #C00;*/">
                    <p style="margin: 1px; font-size: 12pt;">NIVEL: {{$curso->nivel_nombre}}</p>
                    <p style="margin: 1px; font-size: 12pt;">CURSO: {{$curso->curso_sigla}} "{{$curso->paralelo}}"</p>
                </div>

            <table width="100%" style="border-collapse: collapse; 
            border-spacing: 0; 
            border: black 1px; 
            margin-bottom: 5px;" class="table table-bordered table-striped">
                <thead style="background-color: lightgray;">
                    <tr>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 11pt;">NRO.</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 11pt;">RUDE</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 11pt;">AP. PATERNO</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 11pt;">AP. MATERNO</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 11pt;">NOMBRE(S)</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($listado as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <!--<tr v-for="personal_destinos in arrayPersonal_Destinos" :key="personal_destinos.idpersonal_destinos">-->
                    <tr>  
                        <td style="border: 1px solid #000; padding: 7px; font-size: 11pt; text-align: center;"><span><?php echo $x; ?></span></td>
                        <?php
                        // $date = date_create($row->fechadestino);
                        // $fechadest = date_format($date,"d/m/Y");
                        ?>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 11pt;"><span>{{$row->est_rude}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 11pt;"><span>{{$row->est_paterno}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 11pt;"><span>{{$row->est_materno}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 11pt;"><span>{{$row->est_nombre}}</span></td>
                        
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            <div style="padding-top: 5px; padding-bottom: 5px; text-align: right; font-size: 12pt; /*font-weight: bold; border: 1px solid #C00;*/">
                La Paz, <?php
                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    echo date('d')." de ".$meses[date('n')-1]." del ".date('Y');
                    ?>
                
            </div>

        </div>
    </main>
    
    <script type="text/php">
            if(isset($pdf)) {
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $pdf->text(310, 760, "$PAGE_NUM - $PAGE_COUNT", $font, 9);
                ');
            }
    </script>
</body>

</html>
