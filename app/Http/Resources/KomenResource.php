<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KomenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pembuatKomen' => $this->pembuatKomen->name,
            'isiKomen' => $this->isi_komen,
            'dibuat' => Carbon::parse($this->created_at)->format('d F Y \p\u\k\u\l H:i'),
        ];
    }
}
