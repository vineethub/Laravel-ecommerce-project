<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'currency' => $this->currency,
            'total_amount' => $this->total_amount,
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'tracking_number' => $this->tracking_number,
            'payment_provider' => $this->payment_provider,
            'provider_payment_id' => $this->provider_payment_id,
            'address' => new AddressResource($this->whenLoaded('address')),
            'items' => OrderItemResource::collection($this->whenLoaded('items')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
