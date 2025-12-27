<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'table_number' => $this->table_number,
            'status' => $this->status,
            'total_amount' => $this->total_amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // Nested order items
            'items' => $this->orderItems->map(function ($item) {
                return [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'total_product_price' => $item->total_product_price,
                    'discount' => $item->discount,
                    'grand_total' => $item->grand_total,
                    'product' => [
                        'id' => $item->product->id,
                        'name' => $item->product->name,
                        'description' => $item->product->description,
                        'price' => $item->product->price,
                        'food_type' => $item->product->food_type,
                        'course_type' => $item->product->course_type,
                        'media' => $item->product->media_id ? url('storage/'.$item->product->media_id) : null,
                    ],
                ];
            }),
          
          
            // Optional: include user info if needed
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'role' => $this->user->role,
            ],
        ];
    }
}
