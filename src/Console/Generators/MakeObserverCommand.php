<?php

namespace Idel\Modular\Console\Generators;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;

class MakeObserverCommand extends Command
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
    protected $signature = 'make:module:observer     
        {slug : The slug of the module.}
        {name : The name of the observer class.}
        {--model= : Generate a module model observer class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module observer class';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $module = $this->argument('slug');
        $observer = $this->argument('name');
        $studlyModule = Str::studly($module);
        $studlyObserver = Str::studly($observer);
        $model = $this->option('model');
        $namespace = "App\\{$studlyModule}\\Observers";
        $dummyModel = "App\\{$studlyModule}\\Entities\\$model";
        $modelDumDollar = "$" . Str::lower($model);
        $directionModule = base_path('modules') .'/' . $module . '/src';
        $template = str_replace([
            'DummyClass',
            'DummyNamespace',
            'NamespacedDummyModel',
            'DummyModel',
            '$dummyModel'
        ],[
            $studlyObserver,
            $namespace,
            $dummyModel,
            $model,
            $modelDumDollar
        ], file_get_contents($this->getStub()));


        if (!$this->files->isDirectory("{$directionModule}/Observers")) {
            $this->files->makeDirectory("{$directionModule}/Observers",0755, true);
        }

        file_put_contents("{$directionModule}/Observers/{$studlyObserver}.php", $template);

        $this->info("\nObserver $studlyObserver has been created!");
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('model')) {
            return __DIR__.'/../../../stubs/observer.model.stub';
        }
        return __DIR__.'/../../../stubs/observer.stub';    
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Observer name'],
            ['slug', InputArgument::REQUIRED, 'Module name'],
            ['model', InputArgument::REQUIRED, 'Model name']
        ];
    }
}