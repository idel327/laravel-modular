<?php

namespace Idel\Modular\Console\Generators\Nova;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;

class MakeFilterCommand extends Command
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
    protected $signature = 'make:module:nova-filter     
        {slug : The slug of the module.}
        {name : The name of the nova-filter class.}';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module nova filter class.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('slug');
        $filter = $this->argument('name');
        $studlyModule = Str::studly($name);
        $namespace = "App\\{$studlyModule}";
        $directionModule = module_path($module , 'src');
        $studlyName = Str::studly($filter);
        $template = str_replace([
            '{{studlyName}}',
            '{{namespace}}',
        ],[
            $studlyName,
            $namespace,
        ], file_get_contents($this->getStub()));

        if (!$this->files->isDirectory("{$directionModule}/Filters")) {
            $this->files->makeDirectory("{$directionModule}/Filters",0755, true);
        }
        file_put_contents("{$directionModule}/Filters/{$studlyName}.php" ,$template);

        $this->info("Nova filters $studlyName has been created!");
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../../stubs/nova/novaFilter.stub';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Nova filter name'],
            ['module', InputArgument::REQUIRED, 'Module name']
        ];
    }
}