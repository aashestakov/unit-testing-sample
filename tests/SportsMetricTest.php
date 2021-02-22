<?php

use PHPUnit\Framework\TestCase;
use Shestakov\Fakes\FakeMailer;
use Shestakov\Http\Client;
use Shestakov\Mailer;
use Shestakov\Mailer\Standard;
use Shestakov\SportsMetric;

class SportsMetricTest extends TestCase
{
    /**
     * @var SportsMetric
     */
    protected $sportsMetric;

    public function setUp(): void
    {
        $mailer = new FakeMailer();
        $httpClientStub = $this->createStub(Client::class);
        $httpClientStub->method('getData')->willReturn('Сообщение по умолчанию');

        $this->sportsMetric = new SportsMetric($mailer, $httpClientStub);
    }

    public function testThatFiveStepsIsBadResult()
    {
        $resultMessage = $this->sportsMetric->analyzeDailyFootsteps(5);
        $this->assertEquals('Ленивая задница', $resultMessage);
    }

    public function testTwoHundredsStepsIsNormalResult()
    {
        $resultMessage = $this->sportsMetric->analyzeDailyFootsteps(200);
        $this->assertEquals('Неплохо', $resultMessage);
    }

    public function testThatEmailNotificationIsSent()
    {
        $mailer = $this->createMock(Standard::class);
        $mailer->expects($this->once())->method('send');
        $client = new Client();
        $sportMetric = new SportsMetric($mailer, $client);
        $sportMetric->analyzeDailyFootsteps(200);
    }
}