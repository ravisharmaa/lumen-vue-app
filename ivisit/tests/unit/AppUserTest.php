<?php

use App\AppUsers;
use Laravel\Lumen\Testing\DatabaseMigrations;

class AppUserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function can_filter_app_users()
    {
        $activeAppUser = factory(AppUsers::class)->state('active')->create();
        $inActiveAppUser = factory(AppUsers::class)->state('inactive')->create();

        $appUser = AppUsers::filter($active = true);

        $this->assertTrue($appUser->contains($activeAppUser));

        $this->assertFalse($appUser->contains($inActiveAppUser));

        $appUser = AppUsers::filter($active = false);

        $this->assertTrue($appUser->contains($inActiveAppUser));

        $this->assertFalse($appUser->contains($activeAppUser));
    }
}
