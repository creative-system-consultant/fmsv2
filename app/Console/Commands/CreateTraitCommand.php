<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class CreateTraitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new livewire trait';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $traitName = $this->argument('name');

        if (!$traitName) {
            $this->error('Please provide a trait name!');
            return false;
        }

        $traitTemplate = $this->getTraitTemplate($traitName);

        $directoryPath = app_path('Traits/' . dirname($traitName));
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        $filePath = "{$directoryPath}/" . class_basename($traitName) . ".php";

        if (File::exists($filePath)) {
            $this->error("Trait {$traitName} already exists!");
            return false;
        }

        File::put($filePath, $traitTemplate);

        $this->info("Trait {$traitName} created successfully.");
    }


    protected function getTraitTemplate($traitName)
    {
        $namespace = 'App\Traits';

        // Check if there's a subdirectory
        if (dirname($traitName) !== '.' && dirname($traitName) !== $traitName) {
            $namespace .= '\\' . str_replace('/', '\\', dirname($traitName));
        }

        $className = class_basename($traitName);

        return <<<EOD
<?php

namespace {$namespace};

trait {$className}
{
    //
}
EOD;
    }
}
