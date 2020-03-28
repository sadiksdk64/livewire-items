<div>
    <h5>Item(s)</h5>
    <div class="row">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">Sl.No.</th>
                    <th scope="col">Name *</th>
                    <th scope="col">Item Category *</th>
                    <th scope="col">Quantity *</th>
                    <th scope="col">Unit Price *</th>
                    <th scope="col">GST</th>
                    <th scope="col">Total</th>
                    <th scope="col">Attachment *</th>
                    <th scope="col">Action</th>
                </tr>

            </thead>
            <tbody>
                @foreach($items as $index => $item)
                {{ Form::hidden("items[$index][id]", $item['id'] ?? null) }}

                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{ Form::text("items[$index][name]", old('items[$index][name]'), ['class' => 'form-control','placeholder' => 'Name', 'wire:model' => "items.$index.name"])}}
                    </td>
                    <td>{{ Form::select("items[$index][bill_item_category_id]", $billItemCategories,$items[$index]['bill_item_category_id'], array('class' => 'userSelect1 form-control'  ,'placeholder' => 'Select Bill Item', 'wire:model' => "items.$index.bill_item_category_id"))}}
                    </td>
                    <td>{{ Form::text("items[$index][quantity]", old('items[$index][quantity]'), ['class' => 'form-control','placeholder' => 'Quantity', 'wire:model' => "items.$index.quantity"])}}
                    </td>
                    <td>{{ Form::text("items[$index][unit_price]", old('items[$index][unit_price]'), ['class' => 'form-control','placeholder' => 'Unit Price','wire:model' => "items.$index.unit_price"])}}
                    </td>
                    <td>{{ Form::number("items[$index][gst]", old('items[$index][gst]'), ['class' => 'form-control','placeholder' => 'GST','wire:model' => "items.$index.gst"])}}
                    </td>
                    <td> {{(is_numeric($items[$index]['quantity']) ? $items[$index]['quantity'] : 0) * (is_numeric($items[$index]['unit_price']) ? $items[$index]['unit_price'] : 0) + (is_numeric($items[$index]['gst']) ? $items[$index]['gst'] : 0)}}
                    </td>
                    <td>
                        @if($item['attachment'])
                        <input type="file" name="attachments[{{$index}}][]" class="form-control">
                        <div>
                            <a href="{{'/'.$item['attachment']['path'] ?? '#'}}" type="button" class="btn btn-primary"
                                target="_blank"> View</a>
                        </div>
                        @else
                        <input type="file" name="attachments[{{$index}}][]" class="form-control">
                        <span><small class="text-danger">Maximum file size cannot exceed more than 2MB </small></span>
                        @endif
                    </td>
                    <td>
                        @if(array_key_last($items) == $index)
                        <a href="#" class="btn btn-primary waves-effect waves-light" wire:click="addItem" data-toggle="tooltip" data-placement="top" title="Add"><i class="fas fa-plus"></i></a>
                        @endif
                        <a href="#" class="btn btn-danger waves-effect waves-light" wire:click="deleteItem({{$index}})" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fas fa-trash"></i></a>

                    </td>
                </tr>
                @endforeach
                <tr>
                    <td></td><td></td><td></td><td></td><td></td><td class="text-right"><b>Total:</b></td><td><b>{{$totalAmount ?? '0'}}</b></td><td></td><td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>