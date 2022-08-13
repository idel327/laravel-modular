<?php

namespace Idel\Modular\Console\Generators;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;

class MakeListenerCommand extends Command
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
    protected $signature = 'make:module:listener     
        {slug : The slug of the module.}
        {name : The name of the listener class.}
        {--event= : Generate a module event listener class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module listener class.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->argument('slug');
        $event = $this->option('event');
        $eventShortName = Str::studly($event);
        $studlyName = Str::studly($name);
        $directionModule = base_path('modules') .'/' . $module . '/src';
        $studlyModule = Str::studly($module);
        $namespace = "App\\{$studlyModule}\\Listeners";
        $eventNamespace = "App\\{$studlyModule}\\Events\\{$eventShortName}";

        $template = str_replace([
            '{{DummyNamespace}}',
            '{{DummyClass}}',
            '{{EventNamespace}}',
            '{{EventShortName}}',
        ],[
            $namespace,
            $studlyName,
            $eventNamespace,
            $eventShortName
         ], file_get_contents($this->getStub()));

        if (!$this->files->isDirectory("{$directionModule}/Listeners")) {
            $this->files->makeDirectory("{$directionModule}/Listeners",0755, true);
        }
        file_put_contents("{$directionModule}/Listeners/{$studlyName}.php" ,$template);

        $this->info("Listener $studlyName has been created!");

    }
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('event')) {
            return __DIR__.'/../../../stubs/listener.event.stub';
        }
        return __DIR__.'/../../../stubs/listener.stub';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Listener name'],
            ['slug', InputArgument::REQUIRED, 'Module name'],
            ['event', InputArgument::REQUIRED, 'Event name'],
        ];
    }
}