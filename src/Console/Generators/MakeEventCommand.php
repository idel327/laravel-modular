<?php

namespace Idel\Modular\Console\Generators;

use Idel\Modular\Console\GeneratorCommand;

class MakeEventCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module:event
    	{slug : The slug of the module.}
    	{name : The name of the event class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module event class';

    /**
     * String to store the command type.
     *
     * @var string
     */
    protected $type = 'Module event';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../../stubs/event.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return module_class($this->argument('slug'), 'Events');
    }
}