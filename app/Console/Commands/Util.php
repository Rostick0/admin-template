<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Util extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:util {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folderAndFile = $this->argument('name');
        $parts = explode('/', $folderAndFile);

        $folderName =  implode('/', array_slice($parts, 0, -1));
        $fileName = ucfirst($parts[count($parts) - 1]);

        $folder = 'app/Utils/' . $folderName;

        if (!(file_exists($folder) || is_dir($folder))) {
            mkdir($folder, 0755, true);
        }

        $fullFilePath = $folder . '/' . $fileName . '.php';
        $namespace = 'App\Utils' . ($folderName ? '\\' . str_replace('/', '\\',  $folderName) : '');

        $stub = <<<EOF
        <?php

        namespace $namespace;

        class $fileName
        {
            // 
        }
        EOF;

        if (file_exists($fullFilePath)) {
            $this->error('Util allready exists.');
            return;
        }
        file_put_contents($fullFilePath, $stub);

        $this->info("Util file $namespace\\$fileName created successfully!");
    }
}
