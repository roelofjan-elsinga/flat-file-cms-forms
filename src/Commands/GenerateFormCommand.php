<?php

namespace FlatFileCms\Forms;

use Illuminate\Console\Command;

class GenerateFormCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flatfilecms:forms:new-form {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new form from the default configuration';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // Generate a new form
    }
}
