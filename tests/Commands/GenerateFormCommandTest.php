<?php

namespace FlatFileCms\Tests\Commands;

use FlatFileCms\Tests\TestCase;
use Illuminate\Support\Facades\Config;

class GenerateFormCommandTest extends TestCase
{
    public function test_calling_command_without_name_results_in_prompts()
    {
        $this->artisan('flatfilecms:forms:new')
            ->expectsQuestion("What is the name of this form?", "testing")
            ->expectsOutput("Created new form: testing")
            ->assertExitCode(0);

        $this->assertTrue($this->fs->hasChild('content/forms/testing.json'));

        $file_contents = json_decode(file_get_contents($this->fs->getChild('content/forms/testing.json')->url()), true);

        $this->assertSame('testing', $file_contents['name']);
        $this->assertSame(false, $file_contents['active']);
        $this->assertSame(true, $file_contents['readonly']);
        $this->assertTrue(count($file_contents['fields']) === 0);
    }

    public function test_calling_command_with_name_results_in_new_form()
    {
        $this->artisan('flatfilecms:forms:new', ['--name' => 'testing'])
            ->expectsOutput("Created new form: testing")
            ->assertExitCode(0);

        $this->assertTrue($this->fs->hasChild('content/forms/testing.json'));

        $file_contents = json_decode(file_get_contents($this->fs->getChild('content/forms/testing.json')->url()), true);

        $this->assertSame('testing', $file_contents['name']);
        $this->assertSame(false, $file_contents['active']);
        $this->assertSame(true, $file_contents['readonly']);
        $this->assertTrue(count($file_contents['fields']) === 0);
    }

    public function test_running_command_with_empty_name_results_in_failure()
    {
        $this->artisan('flatfilecms:forms:new')
            ->expectsQuestion("What is the name of this form?", "")
            ->expectsOutput("You need to supply a name for this form.");

        $this->assertFalse($this->fs->hasChild('content/forms/testing.json'));
    }

    public function test_forms_folder_is_created_when_non_existing()
    {
        Config::set('flatfilecms-forms.folder_path', "{$this->fs->url()}/contents/forms");

        $this->artisan('flatfilecms:forms:new', ['--name' => 'testing'])
            ->expectsOutput("Created new form: testing")
            ->assertExitCode(0);

        $this->assertTrue($this->fs->hasChild('contents/forms/testing.json'));
    }
}
