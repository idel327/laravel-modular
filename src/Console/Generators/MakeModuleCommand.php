<?php

namespace Idel\Modular\Console\Generators;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Helper\ProgressBar;

class MakeModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module 
        {slug : The slug of the module}
        {--normal : Generate a normal module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module';

    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * Array to store the configuration details.
     *
     * @var array
     */
    protected $container;

    /**
     * Create a new command instance.
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->container['slug']        = Str::slug($this->argument('slug'));
        $this->container['name']        = Str::studly($this->container['slug']);
        $this->container['version']     = '0.0.1';
        
        $name = $this->container['name'];
        $this->container['description'] = "This is the description for the {$name} module.";

        $this->container['location']    = config('laravel-modules.modulesPath');
        $this->container['provider']    = "{$name}ServiceProvider";
        $this->container['controller']  = "{$name}Controller";
        $this->container['entity']      = $name;
        $this->container['table']       = Str::pluralStudly($this->container['slug']);
        $this->container['migration']   = now()->format('Y_m_d_his') . '_create_' . $this->container['table'] . '_table';


        $this->displayHeader('make_module_introduction');
        $this->displayHeader('make_module_step_1');
        
        $this->stepOne();
    }

    /**
     * Pull the given stub file contents and display them on screen.
     *
     * @param string $file
     * @param string $level
     *
     * @return mixed
     */
    protected function displayHeader($file = '', $level = 'info')
    {
        $stub = $this->files->get(__DIR__ . "/../../../stubs/{$file}.stub");

        return $this->$level($stub);
    }

    /**
     * Step 1: Configure module manifest.
     *
     * @return mixed
     */
    protected function stepOne()
    {
        $this->container['name']        = $this->ask('Please enter the name of the module:', $this->container['name']);
        $this->container['slug']        = $this->ask('Please enter the slug for the module:', $this->container['slug']);
        $this->container['version']     = $this->ask('Please enter the module version:', $this->container['version']);
        $this->container['order']       = $this->ask('Please enter the order for the module:', 4);
        $this->container['description'] = $this->ask('Please enter the description of the module:', $this->container['description']);

        $this->container['basename']    = Str::studly($this->container['slug']);

        $upper = Str::ucfirst($this->container['basename']);
        $this->container['namespace']   = "App\\{$upper}";

        $this->comment('You have provided the following manifest information:');
        $this->comment('Name:                       ' . $this->container['name']);
        $this->comment('Slug:                       ' . $this->container['slug']);
        $this->comment('Version:                    ' . $this->container['version']);
        $this->comment('Order:                      ' . $this->container['order']);
        $this->comment('Description:                ' . $this->container['description']);
        $this->comment('Basename (auto-generated):  ' . $this->container['basename']);
        $this->comment('Namespace (auto-generated): ' . $this->container['namespace']);

        if ($this->confirm('If the provided information is correct, type "yes" to generate.')) {
            $this->comment('Thanks! That\'s all we need.');
            $this->comment('Now relax while your module is generated.');

            $this->generate();
        } else {
            return $this->stepOne();
        }

        return true;
    }

    /**
     * Generate the module.
     */
    protected function generate()
    {
        $steps = [
            'Generating module...'      => 'generateModule',
           'Optimizing module cache...' => 'optimizeModules',
        ];

        $progress = new ProgressBar($this->output, count($steps));
        $progress->start();

        foreach ($steps as $message => $function) {
            $progress->setMessage($message);
            $this->$function();
            $progress->advance();
        }

        $progress->finish();

        event($this->container['slug'] . '.module.made');

        $this->info("\nModule generated successfully.");
    }

    /**
     * Generate defined module folders.
     */
    protected function generateModule()
    {
        $location   = $this->container['location'];
        $folderName = $this->container['slug'];


        if (!$this->files->isDirectory($location)) {
            $this->files->makeDirectory($location);
        }

        $directory = "{$location}/{$folderName}";

        $structure = 'base';

        if($this->option('normal')) :
            $structure = 'normal';
        endif;

        $source    = __DIR__ . "/../../../structure/{$structure}";

        if (! $this->files->isDirectory($directory)) {

            $this->files->makeDirectory($directory);

            $sourceFiles = $this->files->allFiles($source, true);

            foreach ($sourceFiles as $file) {

                $contents = $this->replacePlaceholders($file->getContents());
                $subPath = $file->getRelativePathname();

                $filePath = $directory . '/' . $subPath;

                if ($file->getFilename() === 'ServiceProvider.php') {
                    $filePath = str_replace('ServiceProvider', $this->container['provider'], $filePath);
                } else if($file->getFilename() === 'ModuleController.php') {
                    $filePath = str_replace('ModuleController', $this->container['controller'], $filePath);
                } else if($file->getFilename() === "Entity.php") {
                    $filePath = str_replace('Entity', $this->container['entity'], $filePath);
                } else if($file->getFilename() === "migration.php") {
                    $filePath = str_replace('migration.php', $this->container['migration'] . ".php" , $filePath);
                } else if($file->getFilename() === "config.php") {
                    $filePath = str_replace('config.php', $this->container['slug'] . ".php" , $filePath);
                }

                $dir = dirname($filePath);

                if (! $this->files->isDirectory($dir)) {
                    $this->files->makeDirectory($dir, 0755, true);
                }

                $this->files->put($filePath, $contents);
            }
        }

    }

    protected function replacePlaceholders($contents)
    {
        $find = [
            'DummyBasename',
            'DummyNamespace',
            'DummyName',
            'DummySlug',
            'DummyVersion',
            'DummyOrder',
            'DummyDescription',
            'DummyLocation',
            'DummyProvider',
            'DummyController',
            'DummyEntity',
            'DummyTable',
        ];

        $replace = [
            $this->container['basename'],
            $this->container['namespace'],
            $this->container['name'],
            $this->container['slug'],
            $this->container['version'],
            $this->container['order'],
            $this->container['description'],
            $this->container['location'],
            $this->container['provider'],
            $this->container['controller'],
            $this->container['entity'],
            $this->container['table'],
        ];

        return str_replace($find, $replace, $contents);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['normal', 'n', InputOption::VALUE_NONE, 'Normal Module'],
        ];
    }

    /**
     * Reset module cache of enabled and disabled modules.
     */
    protected function optimizeModules()
    {
        return $this->callSilent('module:optimize');
    }
}
