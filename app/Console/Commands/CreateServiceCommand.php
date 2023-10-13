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

        if (dirname($serviceName) === 'Model') {
            return <<<EOD
<?php

namespace {$namespace};

/**
 * Service class for managing {$className}-related operations.
 */
class {$className}
{
    /**
     * Fetches all {$className} from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection Collection of Model{$className} instances.
     */
    public static function getAll{$className}()
    {
        //return
    }

    /**
     * Fetches the search data for CIF customers based on the provided parameters.
     *
     * @param array \$conditions Associative array with keys as column names and values as the condition to match.
     * @param string|null \$search The search keyword.
     * @param string|null \$searchBy The column to search by.
     * @param string|null \$sortField The column to sort by.
     * @param string|null \$sortDirection The direction to sort (asc or desc).
     * @param array \$relationships Associative array with keys as column names and values as the condition to match.
     * @return \Illuminate\Pagination\LengthAwarePaginator Paginated result set.
     */
    public static function fetchByCondition(
        array \$conditions = [],
        \$searchBy = null,
        \$search = null,
        \$sortField = null,
        \$sortDirection = null,
        array \$relationships = []
    ) {
        //\$query = Model::query();  -- change model name

        if (!empty(\$relationships)) {
            \$query->with(\$relationships);
        }

        foreach (\$conditions as \$condition) {
            \$method = array_shift(\$condition);

            if (strpos(\$method, '.') !== false) {
                [\$relation, \$relationMethod] = explode('.', \$method);
                \$query->whereHas(\$relation, function (\$subQuery) use (\$relationMethod, \$condition) {
                    call_user_func_array([\$subQuery, \$relationMethod], \$condition);
                });
            } else {
                call_user_func_array([\$query, \$method], \$condition);
            }
        }

        if (\$search && \$searchBy) {
            \$query->where(\$searchBy, 'like', '%' . \$search . '%');
        }

        if (\$sortField && \$sortDirection) {
            \$query->orderBy(\$sortField, \$sortDirection);
        }

        return \$query->paginate(10);
    }

    /**
     * Creates a new {$className} entry in the database.
     *
     * @param array \$data The data for the entry.
     */
    public static function create{$className}(\$data)
    {
        //return
    }

    /**
     * Updates an existing {$className}'s data by key.
     *
     * @param string \$key The key of the table to update.
     * @param array \$data The data to update.
     */
    public static function update{$className}(\$key, \$data)
    {
        //return
    }

    /**
     * Deletes a {$className} by their key.
     *
     * @param string \$key The key of the table to delete.
     */
    public function delete{$className}(\$key)
    {
        //return
    }
}
EOD;
        } else {
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
}
