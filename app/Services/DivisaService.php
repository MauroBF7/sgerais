<?php
namespace App\Services;
use Illuminate\Supporte\Facades\File;

class DivisaService
{
    protected $path;
    public function _construtct()
    {
            $this->path = resource_path('data/divisas.json');
    }
    public function all(){
        return collect(json_decode(File::get($this->path),true));
    }
    public function findBySigla(string $sigla): ?array
    {
        return $this->all()->firstWhere('sigla',strtoupper($sigla));
    }
    public function findById(int $id): ?array
    {
        return $this->all()->firstWhere('id',$id);
    }
}
