<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DESTINOS INDIVIDUALES</title>
    <!-- CSS only -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> --}}
    <style>
        @page{
            /*margin: 0rem;
            margin-top:0rem;
            padding: 1rem;*/
            margin: 0cm 0cm;
        }
        body {
            /*margin: 0px;*/
            margin-top: 2cm;
            margin-bottom: 2cm;
            /** margenes de izquierda y derecha es menos un cm*/
            margin-left: 2cm;
            margin-right: 1cm;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 3cm;
            right:2cm;
            height: 2cm;
            /*background-color: #3498DB;*/
            color: black;
            text-align: right;
            line-height: 24px;
            /*font-size: 9px;
            border: 1px solid #C00;*/
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
        .cabecera {
            background-color: #FEFEFE;
            color: #000000;
            padding: 2rem;
            padding-top: .2rem;
            padding-bottom: 0px;
        }
        .cabecera .logo{
            margin: 5px;
        }
        .cabecera table {
            padding: 1px;
            margin-bottom: .2rem;
        }
        table {
            font-size: x-small
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }

    </style>
</head>
<body>

<header>
        <!--<h6>Fecha de Emisión:--> 
        <?php
            //$fecha = date("dHi - M - Y");
            //echo $fecha;
        ?>
        <!--<img src="data:image/png;base64, {!! base64_encode($qr) !!} ">
        </h6>-->
        <div>
            <img src="data:image/png;base64, {!! base64_encode($qr) !!} ">
        </div>
</header> 

<footer>
        
        <div style="text-align: right;">
            <h6>Desarrollado por la: DIGETIC - <?php
                $gestion_act = date("Y");
                echo $gestion_act;
                ?>
            </h6>
        </div>
</footer>

    <main>  
    
        <div class="cabecera">
        <!--border: 1px solid #C00;-->
                <div style="text-align: center; width: 230px; font-size: 11.5px; margin-top: 0cm;/*border: 1px solid #C00;*/">
                    <p style="margin: 0px">FUERZA AÉREA BOLIVIANA</p>
                    <p style="margin: 0px 0px">DEPARTAMENTO I - PERSONAL EMGFAB</p>
                    <p style="margin: 0px 0px;"><u><strong>BOLIVIA</strong></u></p>
                </div>

                
                
                <div style="padding-top: 30px; padding-bottom: 30px; text-align: center; font-size: 15px; font-weight: bold; /*border: 1px solid #C00;*/">
                    <p style="margin: 1px">DESTINOS INDIVIDUALES</p>
                </div>
                <div style="padding-top: 5px; padding-bottom: 5px; text-align: left; font-size: 12px; font-weight: bold; /*border: 1px solid #C00;*/">
                    @if($personal->per_sexo=='MASCULINO')
                        <p style="margin: 1px">DEL SEÑOR: {{$personal->gra_abreviatura}}{{$personal->estu_abreviatura}} {{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</p><br>
                    @endif
                    @if($personal->per_sexo=='FEMENINO')
                        <p style="margin: 1px">DE LA SEÑORA: {{$personal->gra_abreviatura}}{{$personal->estu_abreviatura}} {{$personal->per_nombre}} {{$personal->per_paterno}} {{$personal->per_materno}}</p><br>
                    @endif
                    <p  style="margin: 1px">CARNET MILITAR: {{$personal->per_cm}}</p>
                </div>

            <table width="100%" style="border-collapse: collapse; 
            border-spacing: 0; 
            border: black 1px; 
            margin-bottom: 5px;" class="table table-bordered table-striped">
                <thead style="background-color: lightgray;">
                    <tr>
                        <th style="text-align: center; border: 1px solid #000; height:30px; font-size: 10px;">NRO.</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">FECHA</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">ORGANISMO</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">GRAN UNIDAD</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">REPARTICIÓN</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">SUBREPARTICIÓN</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">PRIMER CARGO</th>
                        <th style="text-align: center; border: 1px solid #000; height:30px;font-size: 10px;">SEGUNDO CARGO</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    <?php
                        $x = 0;
                    ?>
                    @foreach($personal_destinos as $row)
                    <?php
                        $x = $x + 1;
                    ?> 
                    <!--<tr v-for="personal_destinos in arrayPersonal_Destinos" :key="personal_destinos.idpersonal_destinos">-->
                    <tr>  
                        <td style="border: 1px solid #000; padding: 7px; font-size: 9px; text-align: center;"><span><?php echo $x; ?></span></td>
                        <?php
                        $date = date_create($row->perdest_fechadestino);
                        $fechadest = date_format($date,"d/m/Y");
                        ?>
                        <!--<td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$row->perdest_fechadestino}}</span></td>-->
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span><?php echo $fechadest; ?></span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$row->destn1_descripcion}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$row->destn2_descripcion}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$row->destn3_descripcion}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$row->destn4_descripcion}}</span></td>
                        <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$row->cargo}}</span></td>
                        @foreach($personal_destinos2 as $item)
                            @if($item->idpersonal_destinos2 == $row->idpersonal_destinos)
                                <td style="border: 1px solid #000; padding: 7px; font-size: 8px;"><span>{{$item->cargo2}}</span></td>
                            @endif
                        @endforeach
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            <div style="padding-top: 5px; padding-bottom: 5px; text-align: right; font-size: 12px; /*font-weight: bold; border: 1px solid #C00;*/">
                La Paz, <?php
                    $fecha = date("d/M/Y");
                    echo $fecha;
                    ?>
                
            </div>

            <div style="padding-top: 100px; padding-bottom: 0px; text-align: center; /*font-size: 15px; font-weight: bold; border: 1px solid #C00;*/">
            <p style="margin: 1px; font-size: 12px;">{{$jefe_dpto->gra_abreviatura}}{{$jefe_dpto->estu_abreviatura}} {{$jefe_dpto->per_nombre}} {{$jefe_dpto->per_paterno}} {{$jefe_dpto->per_materno}}</p>
                <p style="margin: 1px; font-size: 12px; font-weight: bold;">JEFE DEL DEPARTAMENTO I - PERSONAL EMGFAB</p>
            </div>
            <!--<div>
            <img src="data:image/png;base64, {!! base64_encode($qr) !!} ">
            </div>-->
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
