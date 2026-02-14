<?php

use Illuminate\Support\Facades\File;

it('creates repository class', function () {

    $this->artisan('make:repository User/UserRepository --force')
        ->assertExitCode(0);

    $file = app_path('Domains/User/Repositories/UserRepository.php');

    expect(File::exists($file))->toBeTrue();

    $content = File::get($file);

    expect($content)->toContain('class UserRepository');
    expect($content)->toContain('namespace App\\Domains\\User\\Repositories');

    afterEach(function () {
        File::deleteDirectory(app_path('Domains'));
        File::deleteDirectory(app_path('Application'));
    });
});
