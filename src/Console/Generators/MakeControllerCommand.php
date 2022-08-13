<?php

namespace Idel\Modular\Console\Generators;

use Symfony\Component\Console\Input\InputOption;
use Idel\Modular\Console\GeneratorCommand;

class MakeControllerCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module:controller
    	{slug : The slug of the module}
    	{name : The name of the controller class}
    	{--api : Generate a module api controller class}
    	{--resource : Generate a module resource controller class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module controller class';

    /**
     * String to store the command type.
     *
     * @var string
     */
    protected $type = 'Module controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('resource')) {
            return $this->makeStub('controller.resource.stub');
        } else if($this->option('api')) {
            return $this->makeStub('controller.api.stub');
        }
        return $this->makeStub('controller.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     * @throws \App\Foundation\Found\Exceptions\ModuleNotFoundException
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return module_class($this->argument('slug'), 'Http\\Controllers');
    }
    

    /**
     * Make stub
     *
     * @param string $stubName 
     * @return string
     */
    protected function makeStub(string $stubName)
    {
        return __DIR__."/../../../stubs/{$stubName}";
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['resource', 'r', InputOption::VALUE_NONE, 'Create a new module controller class with resource functions'],
            ['api', 'a', InputOption::VALUE_NONE, 'Exclude the create and edit methods from the controller.'],
        ];
    }
}
