<div class="container">
  <div class="content"><br>
    <div class="row">
        <nav><div class="nav-wrapper teal lighten-3" >
            <form><div class="input-field">
                <input id="search" class="filterResults" name="table_search" class="form-control input-sm pull-right" type="search" required />
                <label for="search"><i class="zmdi zmdi-search"></i></label></div>
            </form>
        </div></nav>
    </div>
    
    <div class="row">
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col s3"><a class="active" href="#test1">Comprar</a></li>
          <li class="tab col s3"><a href="#test2">Vender</a></li>
        </ul>
      </div>
      <div id="test1" class="col s12">
        <ul class="collection hoverable">
          @foreach($products as $product)
            @if(($product->businessType == "Venda")&&($product->quantity > 0))
            <li class="collection-item avatar filter products">
              <i class="circle green">{{$product->id}}</i>
              <a href="/action/{{{$product->id}}}" class="title">{{$product->name}} ({{$product->productType}})</a>
              <p>{{$product->user}} <br> <b>{{$product->businessType}}</b>
               <b class="right">Qtd: {{$product->quantity}}</b></p>
              <b class="secondary-content">R$ {{$product->price}}</b>
            </li>
            @endif  
          @endforeach
        </ul>
      </div>
      <div id="test2" class="col s12">
        <ul class="collection hoverable">
          @foreach($products as $product)
            @if(($product->businessType == "Compra")&&($product->quantity > 0))
            <li class="collection-item avatar filter products">
              <i class="circle green">{{$product->id}}</i>
              <a href="/action/{{{$product->id}}}" class="title">{{$product->name}} ({{$product->productType}})</a>
              <p>{{$product->user}} <br> <b>{{$product->businessType}}</b>
               <b class="right">Qtd: {{$product->quantity}}</b></p>
              <b class="secondary-content">R$ {{$product->price}}</b>
            </li>
            @endif  
          @endforeach
        </ul>
      </div>    
    </div>
  </div>
</div>

<script>
$('#business-type').material_select();
$('ul.tabs').tabs(); 

$(".products a").click(function(e){
    e.preventDefault();
    var href = $( this ).attr('href');
    $("#main").load(href);
    $(".side-nav").sideNav('hide');
});
</script>