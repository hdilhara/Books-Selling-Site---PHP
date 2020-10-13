// var script = document.createElement('script');
// script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
// script.type = 'text/javascript';
// document.getElementsByTagName('head')[0].appendChild(script);

// initial();

// function sendCartItems(){
//     if (localStorage.hasOwnProperty('cartItems')){

//         var cartItems=[];
//         var x = localStorage.getItem("cartItems");
//         cartItems = JSON.parse(x);

//         var array = ["thing1", "thing2", "thing3"];

//         var parameters = {
//         "array1[]": array
//         };

//         $.post(
//         'proccess.php',
//         parameters
//         )
//         .done(function(data, statusText) {
//             // This block is optional, fires when the ajax call is complete
//             window.location.replace("./proccess.php");
//         });

//         // var xhttp = new XMLHttpRequest();
//         // xhttp.open("POST", "ajaxfile.php?request=1", true);
//         // xhttp.setRequestHeader('Content-type', "application/json");
//         // xhttp.onreadystatechange = function() {
//         // if (this.readyState == 4 && this.status == 200) {

//         // // Response
//         // var response = this.responseText; 

//         //     }
//         // };
//         // xhttp.send(cartItems);

//     }
// }

// function initial(){
//     if (localStorage.hasOwnProperty('cartItems')){
//         var cartItems=[];
//         var x = localStorage.getItem("cartItems");
//         cartItems = JSON.parse(x);
//         document.getElementById('cart').innerHTML= cartItems.length;
//     }
// }

// function addToCart(val){

//     var cartItems=[];
//     var have = false;

//     console.log(cartItems.length);

//     if (localStorage.hasOwnProperty('cartItems')){
//         var x = localStorage.getItem("cartItems");
//         console.log(x);
//         cartItems = JSON.parse(x);

//     }
//         for(var i=0; i<cartItems.length ; i++ ){
//             if(cartItems[i].product_id == val){
//                 cartItems[i].count++;
//                 have = true;
//                 break;
//             }
//         }
//         if(!have){
//             cartItems.push({product_id : val, count: 1});
//         }
//         localStorage.setItem('cartItems', JSON.stringify(cartItems));
//         document.getElementById('cart').innerHTML= cartItems.length;
// }