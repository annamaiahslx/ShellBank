<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;


class sharepoint {

    private $client_id;
    private $client_secret;
    private $tenant_id;
    private $access_token;
    private $graph_url = 'https://graph.microsoft.com/v1.0';

    public function __construct($params = array()) {

        #$this->load->library('session');

        $this->client_id = 'e1b33d75-75ad-424b-ad7d-597d6d985405';
        $this->client_secret = '7118Q~RT6u4.83FV_R.7bezsSZWsKu14FZyl9bnQ';
        $this->tenant_id = '843ef2e3-cb2f-421e-9f89-cf7dd13a8fdf';
        $this->drive_id = 'b!D3jWVRH3PkKDOeUue1336pXffpCOCihNqB_wrBGjZkYFpATx8o08RIOd7S2vadVl';

    }

    private function getAccessToken()
    {
        if (empty($this->access_token)) {
            $tokenEndpoint = "https://login.microsoftonline.com/$this->tenant_id/oauth2/v2.0/token";
            $data = array(
                'grant_type' => 'client_credentials',
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'redirect_url' => 'http://localhost/',
                'scope'=>  'https://graph.microsoft.com/.default'
            );

            try {
                $client = new Client();
                $response = $client->post($tokenEndpoint, ['form_params' => $data]);
                $body = json_decode($response->getBody(), true);
                $this->access_token = $body['access_token'];
            } catch (RequestException $e) {
                show_error('Error getting access token: ' . $e->getMessage());
            }
        }

        return $this->access_token;
    }

     public function createDocument($folder_name, $fileData, $fileName)
    {

        if(stripos($_SERVER['HTTP_HOST'], 'localhost') != FALSE){
            $base_folder = 'Staging';
        }else if($_SERVER['HTTP_HOST'] ==  '127.0.0.1') {
           $base_folder = 'Staging';
        }else if($_SERVER['HTTP_HOST'] == 'insight-dev.panda.org'){
           $base_folder = 'Staging';
        }else{
            $base_folder = 'CPM Documents';
        }

        $fileName = str_replace(' ', '_', $fileName);
        $fileName = str_replace('/', '', $fileName);
        $fileName = str_replace('?', '', $fileName);
        $fileName = str_replace(':', '', $fileName);
        $fileName = str_replace(',', '', $fileName);
        $fileName = str_replace('*', '', $fileName);
        $fileName = str_replace('"', '', $fileName);
        $fileName = str_replace('#', '', $fileName);
        $fileName = str_replace('-', '', $fileName);
        $fileName = preg_replace('/[^(\x20-\x7F)]*/','', $fileName);

        $accessToken = $this->getAccessToken();
        $createEndpoint = "$this->graph_url/drives/$this->drive_id/root:/$base_folder/$folder_name/$fileName:/content";

        try {
            $client = new Client();

            $headers = [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/octet-stream'
            ];

            $response =  $client->request('PUT', $createEndpoint, [ 
                'headers' => $headers,
                'body' => $fileData
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            show_error('Error creating SharePoint item: ' . $e->getMessage());
        }
    }


    public function getDocument($itemId)
    {

        $accessToken = $this->getAccessToken();
        $url =  "$this->graph_url/drives/$this->drive_id/items/{$itemId}/content";
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
        ];

        try {

            $client = new Client();
          
            $response = $client->request('GET', $url, [
                'headers' => $headers
            ]);

            $fileContents = $response->getBody();
            #file_put_contents($localFilePath, $fileContents);

            return $fileContents; // File downloaded successfully
        } catch (Exception $e) {
            return false; // Download failed
        }
    }

    public function deleteDocument($itemId)
    {
        $accessToken = $this->getAccessToken();
        $url =  "$this->graph_url/drives/$this->drive_id/items/{$itemId}";
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
        ];

        try {

            $client = new Client();
          
            $response = $client->request('DELETE', $url, [
                'headers' => $headers
            ]);
            

            if ($response->getStatusCode() === 204) {
                return true; // Document deleted successfully
            } else {
                return false; // Delete operation failed
            }
        } catch (Exception $e) {
            return false; // Delete operation failed
        }
    }

}
