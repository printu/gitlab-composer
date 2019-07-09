<?php

namespace GitlabComposer;

class AuthWebhook extends Auth
{
    protected $data;

    public function getAllowedIps()
    {
        return $this->confs['allowed_webhook_ips'];
    }

    public function auth()
    {
        if (!$this->confs['webhook_token']) {
            http_response_code(500);
            die("webhook_token is not configured in gitlab.ini, please add it to the composer-gitlab config file");
        }
        if (empty($_SERVER['HTTP_X_GITLAB_TOKEN']) || $_SERVER['HTTP_X_GITLAB_TOKEN'] != $this->confs['webhook_token']) {
            http_response_code(403);
            die("X-Gitlab-Token is not allowed to access");
        }

        return parent::auth();
    }
}