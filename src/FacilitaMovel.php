<?php

namespace NotificationChannels\FacilitaMovel;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Str;
use NotificationChannels\FacilitaMovel\Exceptions\CouldNotSendNotification;

class FacilitaMovel
{
    /** @var HttpClient HTTP Client */
    protected $http;

    /** @var null|string */
    protected $login = null;

    /** @var null|string */
    protected $password = null;

    /**
     * @param null $login
     * @param null $password
     */
    public function __construct($login = null, $password = null)
    {
        $this->login        = $login;
        $this->password     = $password;
    }

    /**
     * Get HttpClient.
     *
     * @return HttpClient
     */
    protected function httpClient()
    {
        return new HttpClient([
            'base_uri' => 'http://api.facilitamovel.com.br',
        ]);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendMessage($to, $params)
    {

        try {

            $api_url = '/api/simpleSend.ft?user='.$this->login.'&password='.$this->password;
            $destinatario = '&destinatario='.$to;
            $msg = '&msg='.urlencode($params['msg']);
            $url = $api_url.$destinatario.$msg;
            $response = $this->httpClient()->get($url);

            return $response;
        } catch (ClientException $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

}
