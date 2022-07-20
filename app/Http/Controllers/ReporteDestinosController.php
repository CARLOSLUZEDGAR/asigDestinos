<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\Fpdf;
//use App\Pdf;

class Pdf extends Fpdf
{
    public function Header()
    {
        //$this->fpdf->SetFont('Arial','I',8);
        
        $this->SetFont('Arial','B',8);
        $this->SetY(0);
        $this->SetX(30);
        $fecha=date("dHi-M-Y");
        //$this->Image('../../../imagenes_qr/'.$fecha.'.png',166,20,30,30);
        //216 ancho de la pagina
        $this->Cell(166,20,utf8_decode($fecha),0,0,'R');
        $this->Ln();
    }
    public function Footer()
    {
        $this->SetFont('Arial','B',8);
        $this->SetY(-20);
        $this->SetX(10);
        $this->Cell(196,20,utf8_decode('Desarrollado por: DIGETIC - Secc. Desarrollo de Sistemas'),0,0,'R');
        $this->SetY(-20);
        $this->SetX(30);
        $this->Cell(166,20,$this->PageNo().' '.'-'.' '.'{nb}',0,0,'C');
    }
    // MULTICELL TABLE
    // variable to store widths and aligns of cells, and line height
	var $widths;
	var $aligns;
	var $lineHeight;

	//Set the array of column widths
	public function SetWidths($w){
		$this->widths=$w;
	}

	//Set the array of column alignments
	public function SetAligns($a){
		$this->aligns=$a;
	}

	//Set line height
	public function SetLineHeight($h){
		$this->lineHeight=$h;
	}

	//Calculate the height of the row
	public function Row($data)
	{
		// number of line
		$nb=0;
		
		// loop each data to find out greatest line number in a row.
		for($i=0;$i<count($data);$i++){
			// NbLines will calculate how many lines needed to display text wrapped in specified width.
			// then max function will compare the result with current $nb. Returning the greatest one. And reassign the $nb.
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		}
		
		//multiply number of line with line height. This will be the height of current row
		$h=$this->lineHeight * $nb;
		
		//Issue a page break first if needed 
		$this->CheckPageBreak($h);
		
		//Draw the cells of current row
		for($i=0;$i<count($data);$i++)
		{
			// width of the current col
			$w=$this->widths[$i];
			
			// alignment of the current col. if unset, make it left.
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			
			//Print the text
			$this->MultiCell($w,5,$data[$i],0,$a);
			
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	public function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	public function NbLines($w,$txt)
	{
		//calculate the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
}

class ReporteDestinosController extends Controller
{
    public $fpdf;
    public $Pdf;
    public function __construct()
    {
         $this->Pdf = new Pdf();
    }
    /*public function personal ($per_codigo)
    {
        $personal_destinos = DB::table("personal_destinos")
            ->join('personal','personal_destinos.perdest_codigocambio','=','personal.per_codigo')
            ->join('destinos_nivel1','personal_destinos.perdest_destn1_codigo','=','destinos_nivel1.id')
            ->join('destinos_nivel2','personal_destinos.perdest_destn2_codigo','=','destinos_nivel2.id')
            ->join('destinos_nivel3','personal_destinos.perdest_destn3_codigo','=','destinos_nivel3.id')
            ->join('destinos_nivel4','personal_destinos.perdest_destn4_codigo','=','destinos_nivel4.id')
            ->join('personal_cargo','personal_destinos.id','=','personal_cargo.cod_dest')
            ->join('cargo','personal_cargo.id_cargo','=','cargo.id')
            ->select('personal_destinos.id as idpersonal_destinos',
                    'destinos_nivel1.destn1_descripcion',
                    'destinos_nivel2.destn2_descripcion',
                    'destinos_nivel3.destn3_descripcion',
                    'destinos_nivel4.destn4_descripcion',
                    'personal.per_nombre',
                    'personal.per_paterno',
                    'personal.per_materno',
                    'personal_destinos.id',
                    'personal_destinos.perdest_codigocambio',
                    'personal_destinos.perdest_destn1_codigo',
                    'personal_destinos.perdest_destn2_codigo',
                    'personal_destinos.perdest_destn3_codigo',
                    'personal_destinos.perdest_destn4_codigo',
                    'personal_destinos.perdest_tipo_doc',
                    'personal_destinos.perdest_nro_doc',
                    'personal_destinos.perdest_fechadestino as pf',
                    'personal_destinos.promocion',
                    'personal_destinos.perdest_estado',
                    'personal_destinos.perdest_observaciones',
                    'cargo.id as idcargo',
                    'cargo.desc_cargo as cargo'
                    )
            ->where('personal_destinos.perdest_codigocambio', '=', $per_codigo)
            ->where('personal_cargo.nivel_cargo',1)
            ->orderBy('personal_destinos.perdest_fechadestino','desc')
            ->get();
            return $personal_destinos;
           
    }*/

    public function createPDF(Request $request)
    {
        $conn = pg_pconnect("host=localhost port=5432 dbname=sipefab_destinos_cargos user=postgres password=lu12ed29");
        $per_codigo = $request->per_codigo;
        $pdf = new Pdf ('P','mm','Letter');
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $fecha = date("dHi-M-Y");
        //$pdf->Image('/public/img/fabprueba.png',50,20,20,10);
        $pdf->SetFont('Arial','B',8);
        $pdf->SetY(20);
        $pdf->SetX(30);
        $pdf->Cell(60,3,utf8_decode('FUERZA AÉREA BOLIVIANA'),0,0,'C');

        //$this->fpdf->SetY(23);
        //$this->fpdf->SetX(30);
        //$this->fpdf->Image('../../../imagenes_qr/'.$fecha.'.png',166,30,30,30);

        $pdf->SetY(23);
        $pdf->SetX(30);
        $pdf->Cell(60,3,utf8_decode('DEPARTAMENTO I PERSONAL - EMGFAB'),0,0,'C');
        $pdf->SetY(26);
        $pdf->SetX(30);
        $pdf->Cell(60,3,utf8_decode('BOLIVIA'),0,0,'C');
        $pdf->Ln(8);
        $pdf->SetFont('Arial','B',20);
        $pdf->SetX(30);
        $pdf->Cell(166,10,utf8_decode('DESTINOS'),0,2,'C');
        $pdf->Ln(5);
        $pdf->SetFont('Arial','I',12);
        $pdf->SetX(30);
        $pdf->MultiCell(166,5,utf8_decode('El suscrito Jefe del Departamento I - Personal del Estado Mayor General de la Fuerza Aérea Boliviana, en uso de sus legitimas atribuciones y a solicitud escrita del interesado.'),0);
        $pdf->Ln(5);
        $respuesta_persona = pg_query($conn,'select * from personal where per_codigo ='.$per_codigo);
        while($row = pg_fetch_assoc($respuesta_persona)){
            if($row['per_sexo'] == 'MASCULINO'){
            $pdf->SetFont('Arial','B',12);
            $pdf->SetX(30);
            $pdf->Cell(166,5,utf8_decode('CERTIFICA LOS SIGUIENTES DESTINOS DEL:'),0,2,'L');
            $pdf->Ln(5);
            $pdf->SetFont('Arial','B',18);
            $pdf->SetX(30);
            $pdf->MultiCell(166,10,utf8_decode($row['per_nombre'].' '.$row['per_paterno'].' '.$row['per_materno']),0,'C');
            $pdf->Ln(0);
            }
            else{
                $pdf->SetFont('Arial','B',12);
                $pdf->SetX(30);
                $pdf->Cell(166,5,utf8_decode('CERTIFICA LOS SIGUIENTES DESTINOS DE LA:'),0,2,'L');
                $pdf->Ln(5);
                $pdf->SetFont('Arial','B',18);
                $pdf->SetX(30);
                $pdf->MultiCell(166,10,utf8_decode($row['per_nombre'].' '.$row['per_paterno'].' '.$row['per_materno']),0,'C');
                $pdf->Ln(0);
            }
        }
        $pdf->Ln(5);
        $pdf->SetFillColor(232,232,232);
        $pdf->SetFont('Arial','B',8);
        $pdf->SetX(30);
        $pdf->Cell(10,10,'NRO.',1,0,'C',1);
        $pdf->SetX(40);
        $pdf->Cell(30,10,'FECHA DOCUMENTO',1,0,'C',1);
        $pdf->SetX(70);
        $pdf->Cell(40,10,'REPARTICION',1,0,'C',1);
        $pdf->SetX(110);
        $pdf->Cell(40,10,'SUBREPARTICION',1,0,'C',1);
        $pdf->SetX(150);
        $pdf->Cell(23,10,'PRIMER CARGO',1,0,'C',1);
        $pdf->SetX(173);
        $pdf->Cell(23,10,'SEGUNDO CARGO',1,0,'C',1);
        $pdf->Ln();
        $x = 0;
        $respuesta = pg_query($conn,'select  personal_destinos.perdest_nro_doc,
                                    personal_destinos.perdest_tipo_doc,
                                    personal_destinos.perdest_fechadestino,
                                    destinos_nivel3.destn3_descripcion,
                                    destinos_nivel4.destn4_descripcion,
                                    cargo.desc_cargo
                                    from personal_destinos
                                    join personal on personal.per_codigo = personal_destinos.perdest_codigocambio
                                    join destinos_nivel1 on personal_destinos.perdest_destn1_codigo = destinos_nivel1.id
                                    join destinos_nivel2 on personal_destinos.perdest_destn2_codigo = destinos_nivel2.id
                                    join destinos_nivel3 on personal_destinos.perdest_destn3_codigo = destinos_nivel3.id
                                    join destinos_nivel4 on personal_destinos.perdest_destn4_codigo = destinos_nivel4.id
                                    join personal_cargo on personal_destinos.id = personal_cargo.cod_dest
                                    join cargo on personal_cargo.id_cargo = cargo.id
                                    where personal_destinos.perdest_codigocambio ='.$per_codigo
                                    .'and personal_cargo.nivel_cargo = 1
                                    order by personal_destinos.perdest_fechadestino desc');
        //$respuesta = $this->personal($per_codigo);
        $pdf->SetX(30);
        $pdf->SetWidths(Array(10,30,40,40,23,23));
        $pdf->SetLineHeight(5);
        $x = 0;
        $pdf->SetX(30);
        //while($row = $respuesta){
        while($row = pg_fetch_assoc($respuesta)){
            $pdf->SetFont('Arial','',8);
            $pdf->SetX(30);
            $x = $x + 1;
            $pdf->Row(Array(
                $x,
                $row['perdest_fechadestino'],
                $row['destn3_descripcion'],
                $row['destn4_descripcion'],
                $row['desc_cargo'],
            ));
        }
        ob_clean();
        $pdf->Output();
        exit;
    }
}

