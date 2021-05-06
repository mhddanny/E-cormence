<h5 class="text-primary mt-4">Product Variants</h5>
<br>
<div class="row">
    @foreach ($produk->variants as $item)
        <input type="number" name="{{ 'variants['. $item->kd_produk . '][kd_produk]' }}" id="{{$item->kd_produk}}" value="{{$item->kd_produk}}" hidden>
        
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('kode') ? 'has-error' : '' }}">
                <label for="kode">Kode</label>
                <input name="{{ 'variants['. $item->kd_produk . '][kode]' }}" type="text" class="form-control  @error('kode') is-invalid @enderror" value="{{ $item->kode }}"  placeholder="Enter Kode" >
                @error('kode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Name</label>
                <input name="{{'variants['. $item->kd_produk .'][name]'}}" type="text" class="form-control  @error('name') is-invalid @enderror" value="{{ $item->name }}"  placeholder="Enter name" >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">price (Rp)</label>
                <input name="{{'variants['. $item->kd_produk .'][price]'}}" type="number" class="form-control  @error('price') is-invalid @enderror" value="{{ $item->price }}"  placeholder="Enter price" >
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('qty') ? 'has-error' : '' }}">
                <label for="qty">Jumlah Produk</label>
                <input name="{{'variants['. $item->kd_produk .'][qty]'}}" type="number" class="form-control  @error('qty') is-invalid @enderror" value="{{ ($item->produkInventory) ?  $item->produkInventory->qty : old('qty') }}"  placeholder="Enter qty" >
                @error('qty')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>    
        </div>
        
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
                <label for="weight">Weight (gram)</label>
                <input name="{{'variants['. $item->kd_produk .'][weight]'}}" type="number" class="form-control  @error('weight') is-invalid @enderror" value="{{ $item->weight }}"  placeholder="Enter weight" >
                @error('weight')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
    @endforeach
</div>
    
