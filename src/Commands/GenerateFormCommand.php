<?php

namespace FlatFileCms\Forms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class GenerateFormCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flatfilecms:forms:new {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new form from the default configuration';

    /**@var string $folder_path*/
    private $folder_path;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $name = $this->option('name');

        if (empty($name)) {
            $name = $this->ask("What is the name of this form?");
        }

        if (empty($name)) {
            $this->error('You need to supply a name for this form.');
            return;
        }

        $this->folder_path = Config::get('flatfilecms-forms.folder_path');

        $this->assertConfigurationFolderExists();

        $configuration = $this->configuration($name);

        file_put_contents("{$this->folder_path}/{$name}.json", json_encode($configuration, JSON_PRETTY_PRINT));

        $this->info("Created new form: {$name}");
    }

    /**
     * Create the form configuration folder if it doesn't exist.
     *
     * @return void
     */
    private function assertConfigurationFolderExists()
    {
        if (! file_exists($this->folder_path)) {
            mkdir($this->folder_path, 0644, true);
        }
    }

    /**
     * Get the default configuration for the new form
     *
     * @param null|string $name
     * @return array
     */
    private function configuration(?string $name): array
    {
        return [
            'name' => $name ?? 'default',
            'active' => false,
            'readonly' => true,
            'fields' => []
        ];
    }
}
