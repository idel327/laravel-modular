<?php

namespace Idel\Modular\Console\Generators;

use Idel\Modular\Console\GeneratorCommand;

class MakeNotificationCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module:notification
        {slug : The slug of the module.}
        {name : The name of the notification class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module notification class';

    /**
     * String to store the command type.
     *
     * @var string
     */
    protected $type = 'Module notification';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../../stubs/notification.stub';
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
        return module_class($this->argument('slug'), 'Notifications');
    }
}