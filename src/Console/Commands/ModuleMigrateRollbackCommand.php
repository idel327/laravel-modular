<?php

namespace Idel\Modular\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Database\Migrations\Migrator;
use Idel\Modular\RepositoryManager;
use Idel\Modular\Repositories\Repository;
use Idel\Modular\Traits\MigrationTrait;
use Symfony\Component\Console\Input\{InputOption , InputArgument};

class ModuleMigrateRollbackCommand extends Command
{
    use MigrationTrait, ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:migrate:rollback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback the last database migrations for a specific or all modules';

    /**
     * The migrator instance.
     *
     * @var \Illuminate\Database\Migrations\Migrator
     */
    protected $migrator;

    /**
     * @var RepositoryManager
     */
    protected $module;

    /**
     * Create a new command instance.
     *
     * @param Migrator $migrator
     * @param RepositoryManager  $module
     */
    public function __construct(Migrator $migrator, RepositoryManager $module)
    {
        parent::__construct();
        $this->migrator = $migrator;
        $this->module   = $module;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->confirmToProceed()) {
            return;
        }

        $this->migrator->setConnection($this->option('database'));
        
        $repository = modules()->location();
        $paths      = $this->getMigrationPaths($repository);

        $this->migrator->setOutput($this->output)->rollback(
            $paths, ['pretend' => $this->option('pretend'), 'step' => (int)$this->option('step')]
        );
    }

    /**
     * Get all of the migration paths.
     *
     * @param \App\Core\Modules\Repositories\Repository $repository
     * @return array
     */
    protected function getMigrationPaths(Repository $repository)
    {
        $slug  = $this->argument('slug');
        $paths = [];

        if ($slug) {
            $paths[] = module_path($slug, 'database/migrations', $repository->location , false);
        } else {
            foreach ($repository->all() as $module) {
                $paths[] = module_path($module['slug'], 'database/migrations', $repository->location , false);
            }
        }

        return $paths;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [['slug', InputArgument::OPTIONAL, 'Module slug.']];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to use.'],
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run while in production.'],
            ['pretend', null, InputOption::VALUE_NONE, 'Dump the SQL queries that would be run.'],
            ['step', null, InputOption::VALUE_OPTIONAL, 'The number of migrations to be reverted.'],
            ['location', null, InputOption::VALUE_OPTIONAL, 'Which modules location to use.'],
        ];
    }
}
