<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(realpath(dirname(__FILE__)) . '/dompdf/autoload.inc.php');

class Pdf
{
    function createPDF($html, $filename, $download, $paper, $orientation){
        $dompdf = new Dompdf\Dompdf();
        $dompdf->load_html($html);
        $dompdf->set_option('isRemoteEnabled',true);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->render();
        if($download)
            $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
        else
            $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
    }

    function neracaPDF($html, $filename='', $download=TRUE, $paper='A4', $orientation='potrait'){
        $dompdf = new Dompdf\Dompdf(array('enable_remote' => true));
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->render();
        $path = 'assets/neraca/'.$filename;
        if($download)
            $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
            if( file_put_contents($path, $dompdf->output()) );
        else
            $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
    }
}
?>