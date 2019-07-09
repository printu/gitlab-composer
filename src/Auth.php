<?php

namespace GitlabComposer;

class Auth
{
    protected $confs;

    public function getAllowedIps()
    {
        return $this->confs['allowed_client_ips'];
    }

    public function auth()
    {
        $ips = $this->getAllowedIps();
        if ($ips) {
            if (!isset($_SERVER['REMOTE_ADDR'])) {
                return true;
            }
            $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
            if (in_array($REMOTE_ADDR, $ips)) {
                return true;
            }
            die($REMOTE_ADDR.' is not allowed to access');
        }

        return true;
    }

    public function setConfig($confs)
    {
        $this->confs = $confs;
    }
}