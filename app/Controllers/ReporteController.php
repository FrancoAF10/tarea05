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
        // aquí NO consultas la BD
        return view('Reporte/filtro');
    }

    public function search() {
        $name = trim($this->request->getGet('superhero_name'));

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

}