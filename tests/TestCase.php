<?php

namespace FlatFileCms\Tests;

use FlatFileCms\Forms\ServiceProvider;
use Illuminate\Support\Facades\Config;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * @var  vfsStreamDirectory
     */
    protected $fs;

    public function setUp(): void
    {
        parent::setUp();

        $this->fs = vfsStream::setup('root', 0777, [
            'content' => [
                'forms' => []
            ]
        ]);

        Config::set('flatfilecms-forms.folder_path', "{$this->fs->url()}/content/forms");
        Config::set('flatfilecms-forms.default_configuration_path', "{$this->fs->url()}/content/forms/default.json");
    }

    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }
}
