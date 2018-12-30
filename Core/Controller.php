<?php
/**
 * Created by PhpStorm.
 * User: olexii
 * Date: 12/29/18
 * Time: 7:12 PM
 */

namespace Core;

use Database\Database;

class Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->view = new View();
    }
}