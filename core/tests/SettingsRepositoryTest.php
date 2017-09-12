<?php

use App\Models\Settings;
use App\Repositories\SettingsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SettingsRepositoryTest extends TestCase
{
    use MakeSettingsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SettingsRepository
     */
    protected $settingsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->settingsRepo = App::make(SettingsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSettings()
    {
        $settings = $this->fakeSettingsData();
        $createdSettings = $this->settingsRepo->create($settings);
        $createdSettings = $createdSettings->toArray();
        $this->assertArrayHasKey('id', $createdSettings);
        $this->assertNotNull($createdSettings['id'], 'Created Settings must have id specified');
        $this->assertNotNull(Settings::find($createdSettings['id']), 'Settings with given id must be in DB');
        $this->assertModelData($settings, $createdSettings);
    }

    /**
     * @test read
     */
    public function testReadSettings()
    {
        $settings = $this->makeSettings();
        $dbSettings = $this->settingsRepo->find($settings->id);
        $dbSettings = $dbSettings->toArray();
        $this->assertModelData($settings->toArray(), $dbSettings);
    }

    /**
     * @test update
     */
    public function testUpdateSettings()
    {
        $settings = $this->makeSettings();
        $fakeSettings = $this->fakeSettingsData();
        $updatedSettings = $this->settingsRepo->update($fakeSettings, $settings->id);
        $this->assertModelData($fakeSettings, $updatedSettings->toArray());
        $dbSettings = $this->settingsRepo->find($settings->id);
        $this->assertModelData($fakeSettings, $dbSettings->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSettings()
    {
        $settings = $this->makeSettings();
        $resp = $this->settingsRepo->delete($settings->id);
        $this->assertTrue($resp);
        $this->assertNull(Settings::find($settings->id), 'Settings should not exist in DB');
    }
}
