<div>
    <input wire:model="search" name="search" type="text" class="input search-input" list="mylist" placeholder="Ürün ara..."/>
    {{-- wire:model="search" tanımı bu input için girilen elamanların search livewire ine gönderilmesini tanımlar --}}
    @if (!empty($query))
    <datalist id="mylist" >
        @foreach ($datalist as $rs)
            <option value="{{$rs->title}}">{{$rs->category->title}} </option>
        @endforeach
    </datalist>
        
    @endif
</div>
