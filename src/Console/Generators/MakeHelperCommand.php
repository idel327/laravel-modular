<?php

namespace Idel\Modular\Console\Generators;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;

class MakeHelperCommand extends Command
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
    protected $signature = 'make:module:helper     
        {slug : The slug of the module.}
        {name : The name of the helper file name.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module helper file.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->argument('slug');
        $directionModule = module_path($module);

        if (! $this->files->isFile("{$directionModule}/{$name}.php")) {
            file_put_contents("{$directionModule}/{$name}.php" ,file_get_contents($this->getStub()));
            $this->info("Helper file has been created!");
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
        return __DIR__.'/../../../stubs/emptyPhp.stub';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'helper file name'],
            ['slug', InputArgument::REQUIRED, 'Module name']
        ];
    }
}