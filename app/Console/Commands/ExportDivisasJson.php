<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use App\Models\Divisa;

class ExportDivisasJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:divisas-json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera um Arquivo JSON fixo com as divisas (id, sigla, descricao)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Gerando arquivo JSON de divisas ===');
        
        $path = "{directory}/divisas.json";
        File::put($path, $divisas->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $this->info("{$count} registros exportados com sucesso!");
        $this->line("Arquivo salve em: {$path}");
        return 0;
    }

}
