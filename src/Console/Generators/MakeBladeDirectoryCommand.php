<?php

namespace Idel\Modular\Console\Generators;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;

class MakeBladeDirectoryCommand extends Command
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
    protected $signature = 'make:module:blade-directory     
        {slug : The slug of the module.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a blade directory';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $module = $this->argument('slug');
        $directionModule = module_path($module);

        if (!$this->files->isDirectory("{$directionModule}/resources/views")) {
            $this->files->makeDirectory("{$directionModule}/resources/views",0755, true);
            $this->info("Directory created.");
        } else {
        	$this->error("The directory has already been created!");
        }
    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['slug', InputArgument::REQUIRED, 'Module name']
        ];
    }
}