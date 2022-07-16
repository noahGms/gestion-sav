<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'customer' => CustomerResource::make(optional($this->customer)),
            'comment_state' => $this->comment_state,
            'state' => StateResource::make(optional($this->state)),
            'intervention_date' => $this->intervention_date,
            'intervention' => InterventionResource::make(optional($this->intervention)),
            'depot' => DepotResource::make(optional($this->depot)),
            'return_date' => $this->return_date,
            'return' => ReturnResource::make(optional($this->returnMdl)),
            'type' => TypeResource::make(optional($this->type)),
            'brand' => BrandResource::make(optional($this->brand)),
            'model' => $this->model,
            'serial_number' => $this->serial_number,
            'machine' => $this->machine,
            'defaults' => $this->defaults,
            'observations' => $this->observations,
            'reparations' => $this->reparations,
            'comments' => $this->comments,
            'communications' => $this->communications,
            'created_by' => UserResource::make(optional($this->createdBy)),
            'archived_at' => $this->archived_at,
            'parts' => PartResource::collection($this->parts),
            'users' => UserResource::collection($this->users),
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
