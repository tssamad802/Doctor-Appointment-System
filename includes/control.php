<?php

trait logout_trait
{
    public function logout()
    {
        session_destroy();
        session_unset();
        header("Location: ./login");
        exit;
    }
}

class controller extends model
{
    use logout_trait;
    public function is_empty_inputs($fields = [])
    {
        foreach ($fields as $field) {
            if (empty($field)) {
                return true;
            }
        }
        return false;
    }
}
?>