<?php


namespace biscuit\package;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders( $app )
    {
        return [
            PackageBaseServiceProvider::class
        ];
    }
    public function getEnvironmentSetUp( $app )
    {
        $app['config']->set('database.default', 'testdb');

        $app['config']->set('database.connections.testdb', [
            'driver'    =>  'sqlite',
            'database'  =>  ':memory:'
        ]);

    }
}