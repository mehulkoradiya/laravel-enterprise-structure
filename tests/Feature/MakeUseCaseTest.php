<?php

use Illuminate\Support\Facades\File;

it('creates usecase class', function () {

    $this->artisan('make:usecase User/RegisterUser --force')
        ->assertExitCode(0);

    $file = app_path('Application/User/UseCases/RegisterUser.php');

    expect(File::exists($file))->toBeTrue();

    $content = File::get($file);

    expect($content)->toContain('class RegisterUser');
    expect($content)->toContain('namespace App\\Application\\User\\UseCases');

    afterEach(function () {
        File::deleteDirectory(app_path('Domains'));
        File::deleteDirectory(app_path('Application'));
    });
});
