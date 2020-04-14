<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Items extends Component
{
    public $items = [];
    public $billItemCategories = [];
    public $count = 0;
    public $totalAmount;
    private $keys = ['name','unit_price','quantity','bill_item_category_id','gst','attachment','id'];

    public function mount($items = null)
    {
        $this->billItemCategories = ['General','High','Low'];
        
        if($items == null)
        {
            if(old("items"))
            {
                foreach(old("items") as $item)
                {
                    foreach($this->keys as $key)
                        $this->items[$this->count][$key] = $item[$key] ?? '';
                    $this->count = $this->count + 1;
                }
            } else
            {
                foreach($this->keys as $key)
                    $this->items[$this->count][$key] = '';
                $this->count = $this->count + 1;
            }
        } 
        else
        {
            foreach($items as $item)
            {
                foreach($this->keys as $key)
                    $this->items[$this->count][$key] = $item[$key];
                $this->count = $this->count + 1;
            }
        }
        $total = 0;
        foreach($this->items as $item)
        {
            $total = $total + (is_numeric($item['quantity']) ? $item['quantity'] : 0) * (is_numeric($item['unit_price']) ? $item['unit_price'] : 0) + (is_numeric($item['gst']) ? $item['gst'] : 0);
        }
        $this->totalAmount = $total;
    }

    public function addItem()
    {
        foreach($this->keys as $key)
            $this->items[$this->count][$key] = '';
        $this->count = $this->count + 1;
    }

    public function deleteItem($index)
    {
        if(count($this->items) > 1)
        {
            $this->count = $this->count - 1;
            unset($this->items[$index]); 
        }
    }

    public function hydrate()
    {
        $total = 0;
        foreach($this->items as $item)
        {
            $total = $total + (is_numeric($item['quantity']) ? $item['quantity'] : 0) * (is_numeric($item['unit_price']) ? $item['unit_price'] : 0) + (is_numeric($item['gst']) ? $item['gst'] : 0);
        }
        $this->totalAmount = $total;
    }

    public function render()
    {
        return view('livewire.items');
    }
}
