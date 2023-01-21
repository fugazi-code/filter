<?php

namespace FugaziCode\Filter\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class FilterCreateCommand extends Command
{
    /**
     * Set base path
     */
    private const BASE_PATH = 'App\\Http\\Controllers\\Filters';

    /**
     * Set base path
     */
    private const DIR_PATH = 'Http/Controllers/Filters';

    /**
     * Set namespace
     */
    private const FILTER_PROVIDER_NAMESPACE = 'FugaziCode\Filter\Filter';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filter {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model custom filter';

    /**
     * Filesystem instance
     * @var Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = $this->getSourceFilePath();
        $contents = $this->getSourceFile();
        $this->files->put($path, $contents);
        $this->info("File : {$path} created");
    }

    /**
     * Get the full path of generate class
     *
     * @return string
     */
    public function getSourceFilePath()
    {
        return app_path(self::DIR_PATH) . '/' . $this->argument('name') . '.php';
    }

    /**
     * Return the stub file path
     * @return string
     *
     */
    public function getStubPath()
    {
        return __DIR__ . '/../Stubs/FilterClass.stub';
    }

    /**
     **
     * Map the stub variables present in stub to its value
     *
     * @return array
     *
     */
    public function getStubVariables()
    {
        return [
            'NAMESPACE' => self::BASE_PATH,
            'CLASS_NAME' => $this->argument('name'),
            'FILTER_PROVIDER_NAMESPACE' => self::FILTER_PROVIDER_NAMESPACE,
            'FILTER_PROVIDER' => 'Filter',
        ];
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     *
     */
    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }

    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getStubContents($stub, $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace("$$search$", $replace, $contents);
        }

        return $contents;
    }
}
