<?php

namespace Idel\Modular\Console\Generators;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;

class MakeMailCommand extends Command
{
    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module:mail     
        {slug : The slug of the module.}
        {name : The name of the mail class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module mail class.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->argument('slug');
        $studlyName = Str::studly($name);
        $directionModule = base_path('modules') .'/' . $module . '/src';
        $studlyModule = Str::studly($module);
        $namespace = "App\\{$studlyModule}\\Mails";
        $template = str_replace([
            '{{DummyNamespace}}',
            '{{DummyClass}}'
        ],[
            $namespace,
            $studlyName,
         ], file_get_contents($this->getStub()));

        if (!$this->files->isDirectory("{$directionModule}/Mails")) {

            $this->files->makeDirectory("{$directionModule}/Mails",0755, true);
        }

        file_put_contents("{$directionModule}/Mails/{$studlyName}.php" ,$template);

        $this->info("Mail $studlyName has been created!");

    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../../stubs/mail.stub';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Mail name'],
            ['slug', InputArgument::REQUIRED, 'Module name']
        ];
    }
}