<?php

namespace Idel\Modular\Console\Generators;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;

class MakeRouteCommand extends Command
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
    protected $signature = 'make:module:route     
        {slug : The slug of the module.}
        {name : The name of the route file name.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module route file.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->argument('slug');
        $directionModule = base_path('modules') .'/' . $module;

        if (!$this->files->isDirectory("{$directionModule}/routes")) {
            $this->files->makeDirectory("{$directionModule}/routes",0755, true);
        }

        if (! $this->files->isFile("{$directionModule}/routes/{$name}.php")) {
            file_put_contents("{$directionModule}/routes/{$name}.php" , file_get_contents($this->getStub()));
            $this->info("Route file $name has been created!");
        } else {
            $this->error("$name.php already exists!");
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../../stubs/route.stub';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Route file name'],
            ['slug', InputArgument::REQUIRED, 'Module name']
        ];
    }
}