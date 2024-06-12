<?php 

class Core 
{
    
    function __construct()
    {
		if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->init();
        date_default_timezone_set('Asia/Jakarta');
    }

    function init()
    {
        require_once ('php-mysqli/MysqliDb.php');

        $db = new MysqliDb();
    }

    public function test_db()
    {
        $db = MysqliDb::getInstance();
        if ($db->ping()) {
            echo 'sukses';
        } else {
            echo 'gagal '.$db->getLastError();
        }
    }

    public function select_a()
    {
        $db = MysqliDb::getInstance();
        if ($a = $db->get('admin', 1)) {
            print_r($a);
        } else {
            
        }
        
    }

    // check sdh login apa blm
    public function check_login($value)
    {
        if (isset($_SESSION[$value])) {
            header("Location: index.php");
        } 
    }

    // check ada session admin atau manajer atau tdk
    public function check_session($value)
    {
        if (!isset($_SESSION['admin']) && !isset($_SESSION['manajer'])) {
            header("Location: login.php");
        }
    }

    // proses login
    public function proses_login($username, $password)
    {
        $db = MysqliDb::getInstance();
        $db->where('username', $username);
        $db->where('password', $password);
        $data = $db->getOne('admin');
        if ($db->count > 0) {
            $_SESSION['admin'] = $data; // Set session untuk admin
            return TRUE;
        } else {
            // Jika login admin gagal, coba login manajer
            $db->where('username', $username);
            $db->where('password', $password);
            $data = $db->getOne('manajer');
            if ($db->count > 0) {
                $_SESSION['manajer'] = $data; // Set session untuk manajer
                return TRUE;
            } 
        }
    }

    // logout
    public function logout($value)
    {
        unset($value);
        session_destroy();
        header("Location: ../view/login.php");
    }

    public function json_response($pesan = null, $typeError = null, $code = '')
    {
        header_remove();
        http_response_code($code);
        header("Cache-Controll: no-transform, public, max-age30, s-maxage=900");
        header("Content-type: application/json");
        $status = array(
            200 => '200 OK',
            400 => '400 Bad Request',
            422 => '422 Unprocessable entity',
            500 => '500 Internal server error'
            );
        header("Status:".$status[$code]);
        return json_encode(array(
            'status'=>$code < 300,
            'message'=>$pesan,
            'type'=>$typeError,
            ));
    }
}
?>
