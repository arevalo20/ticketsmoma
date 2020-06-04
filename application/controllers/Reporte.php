<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reporte extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->library('Utilerias');
		$this->load->library('PDF_MC_Table');

		$this->load->model('Reporte_model');
	} // __construct()


	function actividades()
	{
		if (Utilerias::verifica_session_redirige($this)) {
			$anio_mes = $this->input->post('itxt_reporte_mes');
			// $anio_mes = "2019-04";
			// echo $anio_mes; die();
			$arr_aux = explode("-", $anio_mes);
			$anio = $arr_aux[0];
			$mes = $arr_aux[1];

			$ndias = cal_days_in_month(CAL_GREGORIAN, $mes, $anio); // El calendario gregoriano es un calendario originario de Europa, actualmente utilizado de manera oficial en casi todo el mundo
			$dia_primero = 1;
			$dia_ultimo = $ndias;

			$finicial = $anio_mes . "-" . $dia_primero . " 00:00:00";
			$ffinal = $anio_mes . "-" . $dia_ultimo . " 23:59:59";

			$nombre_mes_i = Utilerias::get_nombremes($mes);

			$pdf = new PDF_MC_Table();
			$pdf->AliasNbPages();
			$pdf->AddPage();

			// Arial bold 16
			$pdf->SetFont('Arial', 'B', 14);
			// Logo
			$pdf->Image(base_url('assets/img/logo-omi.png'), 10, 8, 15);

			// Movernos a la derecha, 85cm
			$pdf->Cell(85);
			// Título
			// $pdf->SetTextColor(006,057,057);
			$pdf->SetTextColor(0, 0, 0);
			$pdf->Cell(20, 10, 'REPORTE DE ACTIVIDADES', 0, 1, 'C');
			// $pdf->Image(base_url().'assets/img/favicon.png',168,8,33);

			$pdf->Ln(1);
			$pdf->SetFont('Arial', 'B', 11);
			// $pdf->MultiCell(0,5,utf8_decode($fecha),0,"C");
			// $nombre_mes_i = 'ENERO';
			// $pdf->MultiCell(0,5,"Soporte web Omi vende {$nombre_mes_i} 2019",0,"C");
			$pdf->MultiCell(0, 5, "Soporte web Omi vende {$nombre_mes_i} {$anio}", 0, "C");
			$pdf->Ln(2);

			/*
			$pdf->Ln(1);
			$pdf->SetFont('Arial','B',10);
			$pdf->MultiCell(0,5,utf8_decode($fecha),0,"C");
			$pdf->Ln(2);



			$pdf->SetFont('Arial','B',10);

			// get result
			$result = $this->Reporte_model->inventario();
      */
			$result = $this->Reporte_model->get_tickets($finicial, $ffinal); // $result = array();

			/*


			$pdf->SetTextColor(0, 57, 77);
			$pdf->SetFont('Arial','B',9);
			$text_personalizado = (count($result) == 1)?" armazón":" armazones";
			$pdf->MultiCell(0,5,utf8_decode(count($result). $text_personalizado. " en inventario actual"),0,"L");
			// $pdf->Ln(2);
      */

			//Table with 6 columns
			$pdf->SetWidths(array(18, 79, 92)); // ancho de primer columna, segunda, tercera y cuarta


			// $pdf->SetFillColor(240,255,255);
			$pdf->SetFillColor(158, 178, 205);
			// 006-057-057
			// --
			// $pdf->SetDrawColor(0, 0, 0);
			$pdf->SetAligns(array("C", "C", "C"));
			$pdf->SetColors(array(TRUE, TRUE, TRUE));
			$pdf->SetLineW(array(0.02, 0.02, 0.02));
			// $pdf->SetLineWidth(array(0.2,0.2,0.2,0.2,0.2));

			// $pdf->SetTextColor(28,85,172);
			$pdf->SetTextColor(0, 57, 77);
			$pdf->Row(array(
				// utf8_decode("Armazón"),
				utf8_decode("TICKET"),
				utf8_decode("TÍTULO"),
				utf8_decode("DESCRIPCIÓN")
				// utf8_decode("Catálogo"),
				// utf8_decode("Precio"),
				// utf8_decode("Disponible"),
			));

			$pdf->SetTextColor(006, 057, 057);
			$pdf->SetFont('Arial', '', 10);
			$pdf->SetAligns(array("L", "L", "L"));
			$pdf->SetColors(array(FALSE, FALSE, FALSE));
			// $pdf->SetLineW(array(0.09,0.09,0.09,0.09,0.09));
			// $pdf->SetLineW(array(0.009,0.009,0.009,0.009,0.009));
			$pdf->SetLineW(array(0.002, 0.002, 0.002));
			$cont = 0;
			foreach ($result as $item) {
				$cont++;
				$pdf->Row(array(
					// utf8_decode('algo'),
					utf8_decode($item["ticket"]),
					utf8_decode($item["titulo"]),
					utf8_decode($item["descripcion"])
					// utf8_decode($item["catalogo"]),
					// $item["precio_venta"],
					// $item["inventario_disponible"]
				));
			}
			$pdf->Output();
		}
	} // actividades()

}// class
