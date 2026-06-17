<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ImagemBlob;
use App\Models\ImagemPath;

class TestePerformance extends Command
{
    protected $signature = 'teste:performance';
    protected $description = 'Teste de performance BLOB x PATH';

    public function handle()
    {
        echo "\n===== TESTE DE INSERÇÃO =====\n";

        // -------------------------
        // TESTE BLOB
        // -------------------------
        $inicioBlob = microtime(true);

        for ($i = 1; $i <= 26; $i++) {

            $arquivo = storage_path("app/teste/$i.jpg");

            ImagemBlob::create([
                'nome' => "$i.jpg",
                'imagem' => file_get_contents($arquivo)
            ]);
        }

        $fimBlob = microtime(true);

        echo "Tempo inserção BLOB: "
            . ($fimBlob - $inicioBlob)
            . " segundos\n";


        // -------------------------
        // TESTE PATH
        // -------------------------
        $inicioPath = microtime(true);

        for ($i = 1; $i <= 26; $i++) {

            ImagemPath::create([
                'nome' => "$i.jpg",
                'caminho' => "teste/$i.jpg"
            ]);
        }

        $fimPath = microtime(true);

        echo "Tempo inserção PATH: "
            . ($fimPath - $inicioPath)
            . " segundos\n";


        echo "\n===== TESTE DE BUSCA =====\n";

        // -------------------------
        // BUSCA BLOB
        // -------------------------
        $inicioBuscaBlob = microtime(true);


        $imagemBlob = ImagemBlob::where(
            'nome',
            '25.jpg'
        )->first();

        $fimBuscaBlob = microtime(true);

        echo "Tempo busca BLOB: "
            . ($fimBuscaBlob - $inicioBuscaBlob)
            . " segundos\n";


        // -------------------------
        // BUSCA PATH
        // -------------------------
        $inicioBuscaPath = microtime(true);


        $imagemPath = ImagemPath::where(
            'nome',
            '25.jpg'
        )->first();

        $fimBuscaPath = microtime(true);

        echo "Tempo busca PATH: "
            . ($fimBuscaPath - $inicioBuscaPath)
            . " segundos\n";


        echo "\n===== RESULTADO =====\n";

        echo "Imagem BLOB encontrada: "
            . $imagemBlob->nome . "\n";

        echo "Imagem PATH encontrada: "
            . $imagemPath->caminho . "\n";
    }
}