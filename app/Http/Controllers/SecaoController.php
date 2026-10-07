<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SecaoController extends Controller
{
    private $path;

    public function __construct()
    {
        $this->path = resource_path('data/secoes.json');
    }

    private function getSecoes()
    {
        if (!File::exists($this->path)) {
            return [];
        }

        return json_decode(
            File::get($this->path),
            true
        );
    }

    private function saveSecoes($secoes)
    {
        File::put(
            $this->path,
            json_encode(
                $secoes,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );
    }

    private function getDivisas()
    {
        $pathDivisas = resource_path('data/divisas.json');

        if (!File::exists($pathDivisas)) {
            return [];
        }

        return json_decode(
            File::get($pathDivisas),
            true
        );
    }

    /**
     * Listar as Seções do arquivo
     */
    public function index()
    {
        $pathDivisas = resource_path('data/divisas.json');
        $pathSecoes = resource_path('data/secoes.json');

        // Lê divisas
        $divisas = File::exists($pathDivisas)
            ? json_decode(File::get($pathDivisas), true)
            : [];

        // Lê seções
        $secoes = File::exists($pathSecoes)
            ? json_decode(File::get($pathSecoes), true)
            : [];

        /*
         * Cria índice:
         * FIN => Serviço Financeiro
         * ADM => Administração
         */
        $divisasIndexadas = collect($divisas)
            ->keyBy('sigla');

        // Relaciona as seções com as divisões
        $secoes = collect($secoes)->map(function ($secao) use ($divisasIndexadas) {

            $divisa = $divisasIndexadas
                ->get($secao['siglaDiv']);

            $secao['divisao'] = $divisa['descricao']
                ?? 'Não encontrada';

            return $secao;
        });

        // Agrupa pela divisão
        $secoesAgrupadas = $secoes->groupBy('divisao');

        return view(
            'secoes.index',
            compact('secoesAgrupadas')
        );
    }

    /**
     * Criar uma nova Seção
     */
    public function create()
    {
        return view('secoes.create');
    }

    /**
     * Gravar Seção
     */
    public function store(Request $request)
    {
        $secoes = $this->getSecoes();

        $novoId = count($secoes) > 0
            ? max(array_column($secoes, 'id')) + 1
            : 1;

        $secoes[] = [
            'id' => $novoId,
            'siglaDiv' => $request->siglaDiv,
            'sigla' => $request->sigla,
            'descricao' => $request->descricao
        ];

        $this->saveSecoes($secoes);

        return redirect()->route('secoes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Edição de uma Seção
     */
    public function edit(string $id)
    {
        $secoes = $this->getSecoes();
        $divisas = $this->getDivisas();

        $secao = collect($secoes)
            ->firstWhere('id', (int) $id);

        abort_if(!$secao, 404);

        return view(
            'secoes.edit',
            compact('secao', 'divisas')
        );
    }

    /**
     * Atualização da Seção
     */
    public function update(Request $request, string $id)
    {
        $secoes = $this->getSecoes();

        $secoes = collect($secoes)->map(function ($s) use ($request, $id) {

            if ($s['id'] == $id) {
                $s['siglaDiv'] = $request->siglaDiv;
                $s['sigla'] = $request->sigla;
                $s['descricao'] = $request->descricao;
            }

            return $s;
        })->toArray();

        $this->saveSecoes($secoes);

        return redirect()->route('secoes.index');
    }

    /**
     * Apagar Seção
     */
    public function destroy(string $id)
    {
        $secoes = $this->getSecoes();

        $secoes = collect($secoes)
            ->reject(function ($s) use ($id) {
                return $s['id'] == $id;
            })
            ->values()
            ->toArray();

        $this->saveSecoes($secoes);

        return redirect()->route('secoes.index');
    }
}

