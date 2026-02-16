<?php
require_once 'config.session.inc.php';
class auth
{
    private $allowed_rules = [];

    public function __construct($roles)
    {
        $this->allowed_rules = $roles;
        $this->handle();
    }

    private function handle()
    {
        $allowed = false;
        foreach ($this->allowed_rules as $role) {
            if (isset($_SESSION[$role])) {
                $allowed = true;
                break;
            }
        }
        if (!$allowed) {
            require_once 'logout.inc.php';
            //header("Location: ./login");
            exit;
        }
    }
    public function getId()
    {
        foreach ($this->allowed_rules as $role) {
            if (isset($_SESSION[$role])) {
                return $_SESSION[$role];
            }
        }
        return null;
    }
}
?>