<?php

namespace SplendorDevTpab\Traits;

use Exception;

trait PersonalCodeTrait
{

    /**
    * The personal code to be checked by the API.
    *
    * @since    1.0.0
    * @var      string    $personal_code    The personal code
    */
    protected $personal_code;


    /**
    * Sets the personal code
    *
    * @throws Exception
    */
    protected function set_personal_code()
    {
        if (defined('SPLENDOR_DEV_TPAB_CODIGO_PESSOAL')) {
            $this->personal_code = SPLENDOR_DEV_TPAB_CODIGO_PESSOAL;
        } else {
            throw new Exception('A constante SPLENDOR_DEV_TPAB_CODIGO_PESSOAL não definida');
        }
    }

    public function get_personal_code()
    {
        return $this->personal_code;
    }
}