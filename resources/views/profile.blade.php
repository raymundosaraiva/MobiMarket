<div class="container wrapper-valign">
  <div class="col s11 m6 l6 valign">
    <div class="card-panel grey lighten-5 z-depth-1">
      <div class="row valign-wrapper">
        <div class="col s3 l1">
          <img src="img/{{$profile->img}}"  class="circle responsive-img"> 
        </div>
        <div class="col s9 l11">
          <span class="black-text">
            <h5>{{$profile->name}} <b class="right">R$ {{$profile->account}}</b></h5>
            <h6>{{$profile->email}}</h6>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
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
      <ul class="collection hoverable">
          @foreach($products as $product)
          <li class="collection-item avatar filter">
            @if($product->businessType == "Venda")
            <i class="circle green">{{$product->id}}</i>
            @elseif($product->quantity == 0)
            <i class="circle red">{{$product->id}}</i> [FINALIZADO]
            @else($product->businessType == "Compra")
            <i class="circle blue">{{$product->id}}</i>
            @endif
            <span class="title">{{$product->name}} ({{$product->productType}})</span>
            <p>{{$product->user}} <br> <b>{{$product->businessType}}</b>
               <b class="right">Qtd: {{$product->quantity}}</b>
            </p>
            <a href="#!" class="secondary-content">R$ {{$product->price}}</a>
          </li>
          @endforeach
      </ul>
  </div>
</div>

<script>
    
$("#main").on("keyup", ".filterResults", function(e){
		if (e.keyCode == 13) return false;
		search_str = $(this).val().toLowerCase();
		find = $(".filter");

		for(i = 0 ; i < $(find).length ; i++) {
			name = $(find).eq(i).text().toLowerCase();
			if(name.indexOf(search_str) > -1)
							$(find).eq(i).show();
			else
							$(find).eq(i).hide();
		}
}); 

</script>