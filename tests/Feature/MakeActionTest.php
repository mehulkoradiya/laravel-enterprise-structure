<?php

use Illuminate\Support\Facades\File;

it('creates action class', function () {

    $this->artisan('make:action User/CreateUser')
        ->assertExitCode(0);

    $file = app_path('Domains/User/Actions/CreateUser.php');

    expect(File::exists($file))->toBeTrue();

    $content = File::get($file);

    expect($content)->toContain('class CreateUser');
    expect($content)->toContain('namespace App\\Domains\\User\\Actions');

    afterEach(function () {
        File::deleteDirectory(app_path('Domains'));
        File::deleteDirectory(app_path('Application'));
    });
});
