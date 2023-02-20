<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VersiculoResource extends JsonResource
{
    public static $wrap = 'versiculo';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'capitulo' => $this->capitulo,
            'versiculo' => $this->versiculo,
            'texto' => $this->texto,
            'livro' => $this->livro,
            'links' => [
                [
                    'rel' => 'Alterar um versiculo',
                    'type' => 'PUT',
                    'link' => route('versiculo.update', $this->id)
                ],
                [
                    'rel' => 'Excluir um versiculo',
                    'type' => 'DELETE',
                    'link' => route('versiculo.destroy', $this->id)
                ]
            ]
        ] ;
    }
}
