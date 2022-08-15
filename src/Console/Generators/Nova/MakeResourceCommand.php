<?php

namespace Idel\Modular\Console\Generators\Nova;

use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeResourceCommand extends Command
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
    protected $signature = 'make:module:nova-resource     
        {slug : The slug of the module.}
        {name : The name of the nova resource class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module nova resource class';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $module = $this->argument('slug');
        $resource = $this->argument('name');
        $studlyModule = Str::studly($module);
        $studlyResource = Str::studly($resource);


        $pluralStudly = Str::snake(Str::pluralStudly($resource));
        $labelPluralStudly = Str::studly($pluralStudly);
        $namespace = "App\\{$studlyModule}";
        $resourceModel = "$namespace\\Entities\\$studlyResource";
        $directionModule = module_path($module , 'src');

        $template = str_replace([
            '{{resourceName}}',
            '{{resourceLable}}',
            '{{namespace}}',
            '{{resourceModel}}',
            '{{moduleName}}',
            '{{resourcePermissions}}'
        ],[
            $studlyResource,
            $labelPluralStudly,
            $namespace,
            $resourceModel,
            $studlyModule,
            $pluralStudly
        ], file_get_contents($this->getStub()));

        if (!$this->files->isDirectory("{$directionModule}/Resources")) {
            $this->files->makeDirectory("{$directionModule}/Resources",0755, true);
        }

        file_put_contents("{$directionModule}/Resources/{$studlyResource}.php", $template);
        $this->info("Nova resource $studlyResource has been created!");
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../../stubs/nova/novaResource.stub';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Nova resource name'],
            ['slug', InputArgument::REQUIRED, 'Module name']
        ];
    }
}