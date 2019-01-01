<?php
/**
 * Created by PhpStorm.
 * User: olexii
 * Date: 12/29/18
 * Time: 7:12 PM
 */

namespace Core;

use Database\Database;

/**
 * Class Controller
 * @package Core
 */
class Controller
{
    /**
     * @var Database
     */
    protected $db;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->view = new View();
    }
}