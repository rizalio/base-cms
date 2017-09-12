<?php

use Faker\Factory as Faker;
use App\Models\Settings;
use App\Repositories\SettingsRepository;

trait MakeSettingsTrait
{
    /**
     * Create fake instance of Settings and save it in database
     *
     * @param array $settingsFields
     * @return Settings
     */
    public function makeSettings($settingsFields = [])
    {
        /** @var SettingsRepository $settingsRepo */
        $settingsRepo = App::make(SettingsRepository::class);
        $theme = $this->fakeSettingsData($settingsFields);
        return $settingsRepo->create($theme);
    }

    /**
     * Get fake instance of Settings
     *
     * @param array $settingsFields
     * @return Settings
     */
    public function fakeSettings($settingsFields = [])
    {
        return new Settings($this->fakeSettingsData($settingsFields));
    }

    /**
     * Get fake data of Settings
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSettingsData($settingsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'display_name' => $fake->word,
            'value' => $fake->text,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $settingsFields);
    }
}
