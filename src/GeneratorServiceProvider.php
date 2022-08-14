<?php

namespace Idel\Modular;

use Illuminate\Support\ServiceProvider;

class GeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register the provided services.
     */
    public function register()
    {
        $generators = [
            'module'          => \Idel\Modular\Console\Generators\MakeModuleCommand::class,
            'entity'          => \Idel\Modular\Console\Generators\MakeEntityCommand::class,
            'controller'      => \Idel\Modular\Console\Generators\MakeControllerCommand::class,
            'event'           => \Idel\Modular\Console\Generators\MakeEventCommand::class,
            'job'             => \Idel\Modular\Console\Generators\MakeJobCommand::class,
            'listener'        => \Idel\Modular\Console\Generators\MakeListenerCommand::class,
            'mail'            => \Idel\Modular\Console\Generators\MakeMailCommand::class,
            'middleware'      => \Idel\Modular\Console\Generators\MakeMiddlewareCommand::class,
            'migration'       => \Idel\Modular\Console\Generators\MakeMigrationCommand::class,
            'notification'    => \Idel\Modular\Console\Generators\MakeNotificationCommand::class,
            'observer'        => \Idel\Modular\Console\Generators\MakeObserverCommand::class,
            'policy'          => \Idel\Modular\Console\Generators\MakePolicyCommand::class,
            'provider'        => \Idel\Modular\Console\Generators\MakeProviderCommand::class,
            'request'         => \Idel\Modular\Console\Generators\MakeRequestCommand::class,
            'route'           => \Idel\Modular\Console\Generators\MakeRouteCommand::class,
            'language'        => \Idel\Modular\Console\Generators\MakeLanguageCommand::class,
            'config'          => \Idel\Modular\Console\Generators\MakeConfigCommand::class,
            'helper'          => \Idel\Modular\Console\Generators\MakeHelperCommand::class,
            'blade-directory' => \Idel\Modular\Console\Generators\MakeBladeDirectoryCommand::class,
        ];

        $this->registerCommands($generators);
    }

    /*
     * @params array $generators
     *
     * @return void
     */
    public function registerCommands(array $generators)
    {
        foreach ($generators as $commandName => $class) :

            if ($commandName == 'module') :
                $slug = "command.make.module";
            else:
                $slug = "command.make.module.{$commandName}";
            endif;

            $this->app->singleton($slug, function ($app) use ($class) {
                return $app[$class];
            });
            $this->commands($slug);

        endforeach;
    }
}
