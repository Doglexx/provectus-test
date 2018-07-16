<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

const HOST = 'http://instatestvx.me';

class TestAPI extends TestCase
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected static $client;
    protected $expectedResponse = '{
        "success": false,
        "errors": {
            "email": [""],
            "password": [""],
            "message": "The password and email you entered don\'t match. If you forgot your password, use \"Forgot Password\""
        }
    }';

    public static function setUpBeforeClass()
    {
        self::$client = new \GuzzleHttp\Client([
            'base_uri' => HOST,
            'headers' => ['content-type' => 'application/json', 'Accept' => 'application/json']
        ]);
    }

    /**
     * @param string $login User login
     * @param string $pass User password
     * @dataProvider wrongLoginProvider
     */
    public function testWrongLogin(string $login, string $pass)
    {
        $res = self::$client->request('POST', '/api/auth/login', ['json' => [
            'login' => $login,
            'password' => $pass
        ]]);

        $this::assertEquals(200, $res->getStatusCode(), "Testing status code to be 200.");
        $this->assertJsonStringEqualsJsonString($this->expectedResponse,
                                                $res->getBody()->getContents(),
                                        "Testing JSON response for wrong user.");
    }

    public function wrongLoginProvider()
    {
        return [
            ['login' => 'hello@world.com', 'password' => '12345678']
        ];
    }

    public static function tearDownAfterClass()
    {
        self::$client = null;
    }
}