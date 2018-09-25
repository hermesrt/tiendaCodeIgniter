<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Locales_model extends CI_Model {

    function obtenerLocales(){
        $locales[]=['direccion' => 'tehuelches 761', 'telefono' => '555-55555-55', 'horario' => '8AM - 20PM'];
        $locales[]=['direccion' => 'onas 123', 'telefono' => '66-666-6666', 'horario' => '9AM - 21PM'];
        return $locales;
    }

}

/* End of file Locales_model.php */

?>