<?php

namespace Idel\Modular\Console\Generators\Nova;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;

class MakeValueCommand extends Command
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
    protected $signature = 'make:module:nova-value     
        {slug : The slug of the module.}
        {name : The name of the value class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module nova value metric.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $module = $this->argument('slug');
        $value = $this->argument('name');
        $studlyModule = Str::studly($module);
        $studlyValue = Str::studly($value);
        $namespace = "App\\{$studlyModule}";
        $uriKey = Str::kebab($value);
        $directionModule = module_path($module , 'src');

        $template = str_replace([
            '{{ValueName}}',
            '{{namespace}}',
            '{{uriKey}}',
        ],[
            $studlyValue,
            $namespace,
            $uriKey
        ], file_get_contents($this->getStub()));

        if (!$this->files->isDirectory("{$directionModule}/Metrics")) {
            $this->files->makeDirectory("{$directionModule}/Metrics",0755, true);
        }

        file_put_contents("{$directionModule}/Metrics/{$studlyValue}.php", $template);

        $this->info("Nova value $studlyValue has been created!");
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../../stubs/nova/novaValue.stub';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Nova value name'],
            ['slug', InputArgument::REQUIRED, 'Module name']
        ];
    }
}