<?php

namespace TreeHouse\QueueBundle\Tests\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionConfigurationTestCase;
use TreeHouse\QueueBundle\DependencyInjection\Configuration;
use TreeHouse\QueueBundle\DependencyInjection\TreeHouseQueueExtension;

class ConfigurationTest extends AbstractExtensionConfigurationTestCase
{
    /**
     * @test
     * @dataProvider getConnectionConfigurationFixtures
     *
     * @param string $fixtureName
     * @param array  $expected
     */
    public function it_should_accept_different_connection_configurations($fixtureName, array $expected)
    {
        $sources = [
            sprintf(__DIR__ . '/Fixtures/%s.yml', $fixtureName)
        ];

        $config = [
            'connections' => $expected,
            'driver' => 'amqp',
            'auto_flush' => true,
            'default_connection' => null,
            'publishers' => [],
            'consumers' => [],
            'exchanges' => [],
            'queues' => [],
        ];

        $this->assertProcessedConfigurationEquals($config, $sources);
    }

    /**
     * @return array Fixtures for testing different connection configurations
     */
    public function getConnectionConfigurationFixtures()
    {
        return [
            ['connection1', [
                [
                    'host' => 'localhost',
                    'port' => 5672,
                    'user' => 'guest',
                    'pass' => 'guest',
                    'vhost' => '/',
                ],
            ]],
            ['connection2', [
                [
                    'host' => 'localhost',
                    'port' => 5672,
                    'user' => 'guest',
                    'pass' => 'guest',
                    'vhost' => '/',
                ],
            ]],
            ['connection3', [
                'conn1' => [
                    'host' => 'localhost',
                    'port' => 5672,
                    'user' => 'guest',
                    'pass' => 'guest',
                    'vhost' => '/',
                ],
                'conn2' => [
                    'host' => 'rabbitmqhost',
                    'port' => 123,
                    'user' => 'guest',
                    'pass' => 'guest',
                    'vhost' => '/',
                ],
            ]],
            ['connection4', [
                'conn1' => [
                    'host' => 'localhost',
                    'port' => 5672,
                    'user' => 'guest',
                    'pass' => 'guest',
                    'vhost' => '/',
                ],
                'conn2' => [
                    'host' => 'rabbitmqhost',
                    'port' => 123,
                    'user' => 'guest',
                    'pass' => 'guest',
                    'vhost' => '/',
                ],
            ]],
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getContainerExtension()
    {
        return new TreeHouseQueueExtension();
    }

    /**
     * @inheritdoc
     */
    protected function getConfiguration()
    {
        return new Configuration();
    }
}
