<?php
namespace Shestakov;

use Shestakov\Http\Client;
use Shestakov\Mailer\Mailer;

class SportsMetric
{
    /**
     * @var Mailer
     */
    private $mailer;
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * SportsMetric constructor.
     * @param Mailer $mailer
     * @param Client $httpClient
     */
    public function __construct(Mailer $mailer, Client $httpClient)
    {
        $this->mailer = $mailer;
        $this->httpClient = $httpClient;
    }

    public function analyzeDailyFootsteps(int $footsteps = 0): string 
    {
        $message = $this->httpClient->getData();
        
        if ($footsteps < 100) {
            $message = 'Ленивая задница';
        } else if ($footsteps > 100 && $footsteps < 1000) {
            $message = 'Неплохо';
        } else if ($footsteps > 1000) {
            $message = 'Вы молодец';
        }

        $this->mailer->send();
        
        return $message;
    }
}