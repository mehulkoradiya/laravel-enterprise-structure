<?php

use Illuminate\Support\Facades\File;

it('creates domain structure', function () {

    $this->artisan('make:domain User')
        ->assertExitCode(0);

    expect(File::exists(app_path('Domains/User/Actions')))->toBeTrue();
    expect(File::exists(app_path('Domains/User/Models')))->toBeTrue();
    expect(File::exists(app_path('Domains/User/Policies')))->toBeTrue();
    expect(File::exists(app_path('Domains/User/Repositories')))->toBeTrue();

    afterEach(function () {
        File::deleteDirectory(app_path('Domains'));
        File::deleteDirectory(app_path('Application'));
    });
});
