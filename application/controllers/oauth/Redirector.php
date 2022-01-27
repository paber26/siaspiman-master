<?php

class Redirector extends CI_Controller
{
    public function index()
    {
        $query = http_build_query([
            'client_id' => "18", 
            'redirect_uri' => 'https://dpm.stis.ac.id/oauth/callback', 
            'response_type' => 'code', //gak usah diubah
            'scope' => ''
        ]);
        
        foreach ($_COOKIE as $name => $value) {
            setcookie($name, '', 1);
        }

        header('Location: https://ws.stis.ac.id/oauth/authorize?' . $query);
        
    }
}
