<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LivroResource extends JsonResource
{
    public static $wrap = 'livro';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'nome' => $this->nome,
            'abreviacao' => $this->abreviacao,
            'posicao' => $this->posicao,
            'testamento' => new TestamentoResource($this->whenLoaded('testamento')),
            'versiculos' => new VersiculosCollection($this->whenLoaded('versiculos')),
            'links' => [
                [
                    'rel' => 'Alterar um livro',
                    'type' => 'PUT',
                    'link' => route('livro.update', $this->id)
                ],
                [
                    'rel' => 'Excluir um livro',
                    'type' => 'DELETE',
                    'link' => route('livro.destroy', $this->id)
                ]
            ]
        ];
    }
}
