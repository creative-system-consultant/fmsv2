<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class CreateServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $serviceName = $this->argument('name');

        if (!$serviceName) {
            $this->error('Please provide a service name!');
            return false;
        }

        $serviceTemplate = $this->getServiceTemplate($serviceName);

        $directoryPath = app_path('Services/' . dirname($serviceName));
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        $filePath = "{$directoryPath}/" . class_basename($serviceName) . ".php";

        if (File::exists($filePath)) {
            $this->error("Service {$serviceName} already exists!");
            return false;
        }

        File::put($filePath, $serviceTemplate);

        $this->info("Service {$serviceName} created successfully.");
    }


    protected function getServiceTemplate($serviceName)
    {
        $namespace = 'App\Services';

        // Check if there's a subdirectory
        if (dirname($serviceName) !== '.' && dirname($serviceName) !== $serviceName) {
            $namespace .= '\\' . str_replace('/', '\\', dirname($serviceName));
        }

        $className = class_basename($serviceName);

        return <<<EOD
<?php

namespace {$namespace};

class {$className}
{
    public function __construct()
    {
        //
    }
}
EOD;
    }
}
