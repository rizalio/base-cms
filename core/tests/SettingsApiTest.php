<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SettingsApiTest extends TestCase
{
    use MakeSettingsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSettings()
    {
        $settings = $this->fakeSettingsData();
        $this->json('POST', '/api/v1/settings', $settings);

        $this->assertApiResponse($settings);
    }

    /**
     * @test
     */
    public function testReadSettings()
    {
        $settings = $this->makeSettings();
        $this->json('GET', '/api/v1/settings/'.$settings->id);

        $this->assertApiResponse($settings->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSettings()
    {
        $settings = $this->makeSettings();
        $editedSettings = $this->fakeSettingsData();

        $this->json('PUT', '/api/v1/settings/'.$settings->id, $editedSettings);

        $this->assertApiResponse($editedSettings);
    }

    /**
     * @test
     */
    public function testDeleteSettings()
    {
        $settings = $this->makeSettings();
        $this->json('DELETE', '/api/v1/settings/'.$settings->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/settings/'.$settings->id);

        $this->assertResponseStatus(404);
    }
}
