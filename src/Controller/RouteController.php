<?php

  namespace Acti\AmIUpToDate\Controller;

final class RouteController
{
    private $_routeUrl;

    private $_apiKey;

    private $_headerApiKey;

    public function __construct()
    {
        $this->_routeUrl = get_option('aiutd_route_url');
        $this->_apiKey = get_option('aiutd_api_key');
        $this->_headerApiKey = 'api_key';

        if (!$this->_routeUrl && !$this->_apiKey) {
            error_log('Am I Up To Date - Il faut renseigner les paramètres de l\Api dans le menu outils');
            exit;
        }

        add_action('template_redirect', array($this, 'sendData'));
    }

    public function sendData()
    {
        global $wp;

        if ($wp->request == $this->_routeUrl) {
            $headers = getallheaders();
            if (isset($headers[$this->_headerApiKey]) && $headers[$this->_headerApiKey] == $this->_apiKey) {
                $data = $this->_buildData();
                echo json_encode($data);
                exit;
            }
        }

        wp_redirect(home_url());
        exit;
    }

    private function _buildData()
    {
        $data = array();
        $dataController = new DataController();
        $data['php'] = $dataController->getPhpVersion();
        $data['cms'] = 'wordpress-' . $dataController->getWordpressVersion();
        $data['plugins'] = $dataController->getPluginsVersions();

        return $data;
    }
}
