<?php

namespace tests\DevBoardLib\GithubApiFacade\Client;

use DevBoardLib\GithubApiFacade\Client\KnpLabsClientFactory;
use Mockery as m;

/**
 * Class KnpLabsClientFactoryTest.
 */
class KnpLabsClientFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateTokenAuthenticatedClient()
    {
        $target = new KnpLabsClientFactory();

        $user = m::mock('DevBoardLib\GithubApiFacade\Auth\GithubAccessToken');
        $user->shouldReceive('getGithubAccessToken')->once()->andReturn('access-token');

        $result = $target->createTokenAuthenticatedClient($user);

        self::assertInstanceOf('Github\Client', $result);
    }

    public function testCreateUnauthenticatedClient()
    {
        $target = new KnpLabsClientFactory();

        $result = $target->createUnauthenticatedClient();

        self::assertInstanceOf('Github\Client', $result);
    }
}
