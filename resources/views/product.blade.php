<div class="container wrapper-valign">
  <div class="card-panel grey lighten-5 z-depth-1">
    <div class="row valign-wrapper">
      <div class="col s12">
        <span class="black-text">
          <h5>{{$product->name}} <b class="right">R$ {{$product->price}}</b></h5>
          <b>{{$product->productType}}</b>
          <p>{{$product->user}} 
            <b class="right input-field" style="width:100px">
              <label for="items" class="active" >Quantidade</label>
              <input id="items" type="number" name="quantity" value="1" min="1" max="{{$product->quantity}}"></b>
            <br> <b id="businessType">{{$product->businessType}}</b></p>
        </span>
      </div>
    </div>
  </div>
  <div class="col s4 center">
     <a class="btn waves-effect waves-light green registerAction" data-cod="{{$product->id}}" data-quantity="{{$product->quantity}}" data-price="{{$product->price}}">Efetuar</a> 
  </div>
</div>

