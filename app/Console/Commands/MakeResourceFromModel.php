<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeResourceFromModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:resource-from-model {model} {--collection}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a resource with columns from a model\'s fillable attributes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modelName = $this->argument('model');
        $isCollection = $this->option('collection');

        // Construct full model namespace
        $modelFullName = "App\\Models\\{$modelName}";

        // Check if model exists
        if (! class_exists($modelFullName)) {
            $this->error("Model {$modelName} does not exist!");

            return false;
        }

        // Create model instance
        $model = new $modelFullName;

        // Get fillable columns
        $fillableColumns = $model->getFillable();

        // Prepare resource content
        $resourceContent = $this->generateResourceContent($modelName, $fillableColumns, $isCollection);

        // Determine resource filename
        $resourceFileName = $isCollection
            ? "{$modelName}ResourceCollection.php"
            : "{$modelName}Resource.php";

        // Resource directory
        $resourcePath = app_path('Http/Resources/'.$resourceFileName);

        // Ensure directory exists
        File::ensureDirectoryExists(app_path('Http/Resources'));

        // Write resource file
        File::put($resourcePath, $resourceContent);

        $this->info("Resource [{$resourceFileName}] created successfully.");
    }

    /**
     * Generate resource content
     */
    protected function generateResourceContent(string $modelName, array $fillableColumns, bool $isCollection): string
    {
        $className = $isCollection
            ? "{$modelName}ResourceCollection"
            : "{$modelName}Resource";

        $baseResourceClass = $isCollection
            ? 'ResourceCollection'
            : 'JsonResource';

        // Generate columns mapping for collection or single resource
        $columnsMapping = $isCollection
            ? $this->generateCollectionMapping($fillableColumns)
            : $this->generateSingleResourceMapping($fillableColumns);

        return "<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\\{$baseResourceClass};

class {$className} extends {$baseResourceClass}
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request \$request): array
    {
{$columnsMapping}
    }

    ".($isCollection ? $this->generateWithMethod() : '').'
}
';
    }

    /**
     * Generate mapping for single resource
     */
    protected function generateSingleResourceMapping(array $fillableColumns): string
    {
        $columns = collect($fillableColumns)
            ->map(fn ($column) => "        '{$column}' => \$this->{$column},")
            ->implode("\n");

        return "        return [\n{$columns}\n        ];";
    }

    /**
     * Generate mapping for resource collection
     */
    protected function generateCollectionMapping(array $fillableColumns): string
    {
        $columns = collect($fillableColumns)
            ->map(fn ($column) => "                '{$column}' => \$item->{$column},")
            ->implode("\n");

        return "        return \$this->collection->map(function (\$item) {
            return [
{$columns}
            ];
        })->toArray();";
    }

    /**
     * Generate with method for collection
     */
    protected function generateWithMethod(): string
    {
        return "
    /**
     * Additional metadata for the resource collection.
     *
     * @param Request \$request
     * @return array
     */
    public function with(Request \$request): array
    {
        return [
            'meta' => [
                'total' => \$this->collection->count(),
            ],
        ];
    }";
    }
}
