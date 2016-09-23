<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Action;
use Validator, Input, Redirect, Session, View, DB;

class BaseController extends Controller{
  
  public function getIndex(){ // Get the user's profile and products
    $users =  User::all(); // Get all users from DB
    if(Session::has('user')){ // If there is a user logged
      $email = Session::get("user");
      $user = User::where('email',$email)->first();
      $products = Product::where('userId',$user->id)->get(); // Get the products posted by the current user
      
      foreach($products as $product){     
        $product->user = $user->name; // Insert the current username in all the products
      }
      return view('index', ['users' => $users, 'products' => $products, 'profile' => $user]);
    } else 
      return view('index', ['users' => $users]);  
  }
  
  public function userLogin(){ // Log the user in
    $email = Input::get("email");
    Session::put("user", $email); // Store the user email into a session variable
    $user = User::where('email',$email)->first();
    Session::put("userId", $user->id); // Store the user Id into a session variable
    $products = Product::where('userId',$user->id)->get(); // Get the products posted by the current user

      foreach($products as $product){     
        $product->user = $user->name;
      }
  }
  
  public function showProducts(){ // Lists the products to negociate
    $userId = Session::get("userId");
    $products = Product::where('userId', '!=', $userId)->get(); // Get all products there arent posted by the current user
    
    foreach($products as $product){     
      $user =  User::where('id',$product->userId)->first();
      $product->user = $user->name; // Insert the username in all the products
    }
    return view('productslist', ['products' => $products]);
  }
  
  public function newProduct(){ // Get the Id for the new Product
    $cod = Product::all()->last()->id + 1; 
        
    return view('newproduct', ['cod' => $cod]);
  }
  
  public function getProduct($cod){ // Get the product information informed by its id
    $product = Product::where('id', $cod)->first();  
    $user = User::where('id',$product->userId)->first();
    $product->user = $user->name;
        
    return view('product', ['product' => $product]);
  }
  
  public function actionsList(){ // Lists all the operations
    $userId = Session::get("userId");
    $actions = Action::all();
    
    foreach($actions as $action){
      $product = Product::where('id', $action->productId)->first();  // Get the product information by its id
      $action->name = $product->name;
      if($userId == $product->userId){ // If the current user is the same as the product user
        $action->type = ($product->businessType == "Venda") ? "Vendeu":"Comprou";
        $user = User::where('id',$action->userId)->first();
      } else{
        $action->type = ($product->businessType == "Venda") ? "Comprou":"Vendeu";
        $user = User::where('id',$product->userId)->first();
      }
      
      $action->productType = $product->productType;
      $action->user = $user->name;
    }
    
    return view('actionslist', ['actions' => $actions, 'sessionUserId' => $userId]);
  }
  
  public function registerProduct(){ // Register a new product into the DB
    $product = new Product;
    $product->name = Input::get("name");
    $product->userId = Session::get("userId");
    $product->productType = Input::get("productType");
    $product->quantity = Input::get("quantity");
    $product->price = Input::get("price");
    $product->businessType = Input::get("businessType");
    $product->save();
    
  }
    
  public function registerUser() { // Register a new user into the DB
    $username = Input::get("name");
    $email = Input::get("email");
    $img = Input::get("img");
    $account = Input::get("account");
    $user = User::where('email',$email)->first();
      
    if($user) { // If the user already exists
      return $msg = 'Usuário já Registrado!';
    } else {
      $user = new User;
      $user->name = $username;
      $user->email = $email;
      $user->img = $img;
      $user->account = $account;
      $user->save();
      $msg = null;
    }
      
    return $msg;
  }
  
  public function registerAction() { // Register a new operation(Buy or Sell) into the DB
    $cod = Input::get("cod");
    $items = Input::get("items");
    $total = Input::get("total");
    $currentUserId = Session::get("userId");
    
    $currentUser = User::where('id', $currentUserId)->first(); // Get the current user
    $product = Product::where('id', $cod)->first(); // Get the product
    $businessType = $product->businessType;
    $productUser = User::where('id', $product->userId)->first(); // Get the user that posted the product
    
    $action = new Action;
    $action->productId  = $cod;
    $action->userId  = $currentUserId;
    $action->items  = $items;
    $action->total  = $total;
    $action->save();     // Save the Action
    
    $product->quantity -= $items; //subtract items from the product's quantity
    $product->save();
    
    if($businessType == "Venda"){ // If the operation is 'sell' 
      $currentUser->account -= $total; // Subtract the total from the current's user account
      $productUser->account += $total; // Add the total into the seller's account
    } 
    else{ // If the operation is 'buy'
      $currentUser->account += $total; // Add the total into the current's user account
      $productUser->account -= $total; // Subtract the total from the buyer's user account
    } 
    
    $currentUser->save();
    $productUser->save();

  }
}
