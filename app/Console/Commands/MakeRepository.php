<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {modelName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make repository, interface, and optionally a service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $repositoryName = $this->argument('modelName');

        // Create the Repositories directory if it doesn't exist
        $dirRepositories = app_path('Repositories');
        if (!File::exists($dirRepositories)) {
            File::makeDirectory($dirRepositories);
        }

        // Create the Interfaces directory if it doesn't exist
        $dirInterfaces = app_path('Repositories/Interfaces');
        if (!File::exists($dirInterfaces)) {
            File::makeDirectory($dirInterfaces);
        }

        // Create the repository file
        $repositoryFile = $dirRepositories.'/'.$repositoryName.'Repository.php';
        if (!File::exists($repositoryFile)) {
            $repositoryContent = <<<EOT
<?php

namespace App\Repositories;

use App\Models\\{$repositoryName};

class {$repositoryName}Repository implements Interfaces\\{$repositoryName}RepositoryInterface {

    protected \$model;

    public function __construct({$repositoryName} \$model)
    {
        \$this->model = \$model;
    }

    public function index(\$paginate){
        return \$this->model->paginate(\$paginate);
    }

    public function find(\$id){
        return \$this->model->find(\$id);
    }

    public function create(\$attributes){
        return \$this->model->create(\$attributes);
    }

    public function update(\$model, \$attributes){
        return \$model->update(\$attributes);
    }

    public function delete(\$model){
        return \$model->delete();
    }
}
EOT;
            File::put($repositoryFile, $repositoryContent);
            $this->info("Repositorio {$repositoryName}Repository creado con éxito");
        } else {
            $this->error("El archivo {$repositoryName}Repository ya existe");
        }

        // Create the interface file
        $interfaceFile = $dirInterfaces.'/'.$repositoryName.'RepositoryInterface.php';
        if (!File::exists($interfaceFile)) {
            $interfaceContent = <<<EOT
<?php

namespace App\Repositories\Interfaces;

interface {$repositoryName}RepositoryInterface
{
    public function index(\$paginate);
    public function find(\$id);
    public function create(\$attributes);
    public function update(\$model, \$attributes);
    public function delete(\$model);
}
EOT;
            File::put($interfaceFile, $interfaceContent);
            $this->info("Interfaz {$repositoryName}RepositoryInterface creada con éxito");
        } else {
            $this->error("El archivo {$repositoryName}RepositoryInterface ya existe");
        }

        // Ask if the user wants to create a service
        $createdService = $this->confirm('¿Desea crear el servicio?');

        if ($createdService) {
            // Create the Services directory if it doesn't exist
            $dirServices = app_path('Services');
            if (!File::exists($dirServices)) {
                File::makeDirectory($dirServices);
            }

            // Create the service file
            $fileService = $dirServices.'/'.$repositoryName.'Service.php';
            if (!File::exists($fileService)) {
                $serviceContent = <<<EOT
<?php

namespace App\Services;

use App\Repositories\Interfaces\\{$repositoryName}RepositoryInterface;

class {$repositoryName}Service {

    private \${$repositoryName}RepositoryInterface;

    public function __construct({$repositoryName}RepositoryInterface \${$repositoryName}RepositoryInterface)
    {
        \$this->{$repositoryName}RepositoryInterface = \${$repositoryName}RepositoryInterface;
    }

    // Add your service methods here
}
EOT;
                File::put($fileService, $serviceContent);
                $this->info("Servicio {$repositoryName}Service creado con éxito");
            } else {
                $this->error("El archivo {$repositoryName}Service ya existe");
            }
        }

        return Command::SUCCESS;
    }
}
