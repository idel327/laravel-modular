<?php

namespace Idel\Modular\Console\Generators\Nova;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\{InputArgument , InputOption};
use Illuminate\Filesystem\Filesystem;

class MakeCardCommand extends Command
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
    protected $signature = 'make:module:nova-card     
        {slug : The slug of the module.}
        {name : The name of the nova card class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module nova card class.';

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

        $directionModule = module_path($module , 'src');

        $studlyModule = Str::studly($module);

        $namespace = "App\\{$studlyModule}";

        $uriKey = Str::kebab(preg_replace('/[^a-zA-Z0-9]+/', '', $this->argument('name')));

        $template = str_replace([
            '{{studlyName}}',
            '{{namespace}}',
            '{{uriKey}}'
        ],[
            $studlyName,
            $namespace,
            $uriKey
        ], file_get_contents($this->getStub()));

        if (!$this->files->isDirectory("{$directionModule}/Cards")) {

            $this->files->makeDirectory("{$directionModule}/Cards",0755, true);
        }

        file_put_contents("{$directionModule}/Cards/{$studlyName}.php" ,$template);

        $this->info("Nova card $studlyName has been created!");

    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../../stubs/nova/novaCard.stub';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Nova card name'],
            ['slug', InputArgument::REQUIRED, 'Module name']
        ];
    }
}