<?php

namespace bfinlay\SpreadsheetSeeder\Tests;

use bfinlay\SpreadsheetSeeder\Writers\Database\DestinationTable;
use bfinlay\SpreadsheetSeeder\SpreadsheetSeederServiceProvider;
use bfinlay\SpreadsheetSeeder\SpreadsheetSeederSettings;
use bfinlay\SpreadsheetSeeder\Tests\Seeds\ForeignKeyTruncateTest\ForeignKeyTruncateSeeder;
use Orchestra\Testbench\TestCase;

class ForeignKeyTruncateTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/migrations');

        // and other test setup steps you need to perform
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
            'foreign_key_constraints' => true,
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [SpreadsheetSeederServiceProvider::class];
    }

    /** @test */
    public function it_runs_the_migrations()
    {
        $this->assertEquals([
            'id',
            'created_at',
            'updated_at',
            'user_id',
            'favorite_number'
        ], \Schema::getColumnListing('favorite_numbers'));
    }

    /**
     * Verify that truncating a table with a foreign key constraint throws a foreign key constraint exception
     *
     * @depends it_runs_the_migrations
     */
    public function test_integrity_constraints_prevent_truncation()
    {
        $this->seed(ForeignKeyTruncateSeeder::class);

        $this->assertEquals(2, \DB::table('users')->count());
        $this->assertEquals(2, \DB::table('favorite_numbers')->count());

        $this->expectExceptionMessage('Integrity constraint violation: 19 FOREIGN KEY constraint failed');
        \DB::table('users')->truncate();

        $this->assertEquals(2, \DB::table('users')->count());
        $this->assertEquals(2, \DB::table('favorite_numbers')->count());
    }


    /**
     * Create a new destination table and verify that truncation disables integrity constraints
     *
     * @depends it_runs_the_migrations
     */
    public function test_destination_table_truncation_observes_integrity_constraints()
    {
        $this->seed(ForeignKeyTruncateSeeder::class);

        $settings = resolve(SpreadsheetSeederSettings::class);
        $settings->truncateIgnoreForeign = false;

        $this->assertEquals(2, \DB::table('users')->count());
        $this->assertEquals(2, \DB::table('favorite_numbers')->count());

        $this->expectExceptionMessage('Integrity constraint violation: 19 FOREIGN KEY constraint failed');
        $usersTable = new DestinationTable('users');

        $this->assertEquals(0, \DB::table('users')->count());
        $this->assertEquals(2, \DB::table('favorite_numbers')->count());
    }


    /**
     * Create a new destination table and verify that truncation disables integrity constraints
     *
     * @depends it_runs_the_migrations
     */
    public function test_destination_table_truncation_ignores_integrity_constraints()
    {
        $this->seed(ForeignKeyTruncateSeeder::class);

        $settings = resolve(SpreadsheetSeederSettings::class);
        $settings->truncateIgnoreForeign = true;

        $this->assertEquals(2, \DB::table('users')->count());
        $this->assertEquals(2, \DB::table('favorite_numbers')->count());

        $usersTable = new DestinationTable('users');

        $this->assertEquals(0, \DB::table('users')->count());
        $this->assertEquals(2, \DB::table('favorite_numbers')->count());
    }

}
