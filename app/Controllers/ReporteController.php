<?php 
namespace App\Controllers;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
class ReporteController extends BaseController{
    protected $db;

    public function __construct(){
        $this->db= \Config\Database::connect();
    }

   public function index() {
        return view('Reporte/filtro');
    }

    public function search() {
        $name = trim($this->request->getGet('superhero_name'));//lo que obtenemos del formulario

        $query = "
                SELECT 
                    SH.id,
                    SH.superhero_name,
                    SH.full_name,
                    AL.alignment,
                    R.race
                FROM superhero SH
                LEFT JOIN alignment AL ON SH.alignment_id = AL.id
                LEFT JOIN race R ON SH.race_id = R.id
                WHERE SH.superhero_name LIKE ?
                LIMIT 1
            ";

        $rows = $this->db->query($query, ["%$name%"])->getResultArray();

        // devolvemos JSON para el fetch
        return $this->response->setJSON($rows);
    }
    public function getReport(){
    $name = $this->request->getGet('superhero_name');//lo que obtenemos del formulario

      
    $query = "
            SELECT 
                SH.id,
                SH.superhero_name,
                GROUP_CONCAT(SP.power_name SEPARATOR ', ') AS powers
            FROM hero_power HP
            LEFT JOIN superhero SH ON HP.hero_id = SH.id
            LEFT JOIN superpower SP ON HP.power_id = SP.id
            WHERE SH.superhero_name LIKE ?
            GROUP BY SH.id, SH.superhero_name
            LIMIT 1
    ";

      $rows=$this->db->query($query,["%$name%"]);
      
      $data=["rows"=>$rows->getResultArray()];

      $html=view("reporte/reporte",$data);

      try{
        // P=Vertical, L=Horizontal
        $html2PDF=new Html2Pdf('P','A4','es',true, 'UTF-8',[10,10,10,10]);
        $html2PDF->writeHTML($html);

        $this->response->setHeader('Content-Type','application/pdf');
        $html2PDF->Output('Reporte-SuperHero.pdf');

      }catch(Html2PdfException $e){
        $html2PDF->clean();
        $formatter= new ExceptionFormatter($e);
        echo $formatter->getMessage();
      }
    }

}