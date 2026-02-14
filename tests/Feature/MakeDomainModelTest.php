<?php

use Illuminate\Support\Facades\File;

it('creates domain model', function () {

    $this->artisan('make:domain-model User/User --force')
        ->assertExitCode(0);

    $file = app_path('Domains/User/Models/User.php');

    expect(File::exists($file))->toBeTrue();

    $content = File::get($file);

    expect($content)->toContain('class User');
    expect($content)->toContain('namespace App\\Domains\\User\\Models');

    afterEach(function () {
        File::deleteDirectory(app_path('Domains'));
        File::deleteDirectory(app_path('Application'));
    });
});
