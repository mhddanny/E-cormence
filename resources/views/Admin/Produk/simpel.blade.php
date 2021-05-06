<div class="col-4">
  <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
    <label for="price">Price (Rp)</label>
    <input name="price" type="number" class="form-control  @error('price') is-invalid @enderror" value="{{ $produk->price }}"  placeholder=".00" >
      @error('price')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>

</div>
<div class="col-4">
  <div class="form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
  <label for="weight">Weight (gram)</label>
  <input name="weight" type="number" class="form-control  @error('weight') is-invalid @enderror" value="{{$produk->weight}}"  placeholder="0" >
    @error('weight')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>
<div class="col-4">
  <div class="form-group {{ $errors->has('qty') ? 'has-error' : '' }}">
  <label for="qty">Jumlah Produk</label>
  <input name="qty" type="number" class="form-control  @error('qty') is-invalid @enderror" value="{{ $produk->produkInventory ? $produk->produkInventory->qty : ''}}"  placeholder="0" >
    @error('qty')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>

<div class="col-4">
  <div class="form-group {{ $errors->has('length') ? 'has-error' : '' }}">
  <label for="length">length (Cm)</label>
  <input name="length" type="number" class="form-control  @error('length') is-invalid @enderror" value="{{ $produk->length }}"  placeholder="0" >
    @error('length')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>
<div class="col-4">
  <div class="form-group {{ $errors->has('width') ? 'has-error' : '' }}">
  <label for="width">Width (Cm)</label>
  <input name="width" type="number" class="form-control  @error('width') is-invalid @enderror" value="{{ $produk->width }}"  placeholder="0" >
    @error('width')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>
<div class="col-4">
  <div class="form-group {{ $errors->has('height') ? 'has-error' : '' }}">
  <label for="height">height (Cm)</label>
  <input name="height" type="number" class="form-control  @error('height') is-invalid @enderror" value="{{ $produk->height }}"  placeholder="0" >
    @error('height')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>