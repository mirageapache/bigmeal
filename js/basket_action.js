// ----加入購物籃
var basket_arr = [];
function add_basket(id,name,price,unit,img_path){
	var amount = $('select[name="amount"]').val();
	
	$.ajax({
		url: "/index.php/product/check_amount",
		type: "POST",
		data: {'id':id,'amount':amount} ,
		success: function(result){
			if(result !== false){
				sub_total = result * amount;
				if ($.cookie('basket') == null){ //新增 Cookie
					basket_arr.push({id:id, name:name, price:price, amount:amount, unit:unit, img_path:img_path, sub_total:sub_total});
					$.cookie('basket',JSON.stringify(basket_arr),{ path: '/' });
				}
				else{
					temp_arr = JSON.parse($.cookie('basket'));
					temp_arr.push({id:id, name:name, price:price, amount:amount, unit:unit, img_path:img_path, sub_total:sub_total});
					$.cookie('basket',JSON.stringify(temp_arr),{ path: '/' });
				}
			}
			else{ //庫存不足

			}
			return false;
		}
	});
}

// ---- 從購物籃取消產品 ----
function cancel_item(index){


}

//--------------------------
function get_cookie(){	
	if ($.cookie('basket') != null){
		obj = JSON.parse($.cookie('basket'));
		console.log(JSON.stringify(obj));
	}
}

function delete_cookie(){	
	$.cookie('basket', null, { path: '/', expires: -1 });
}
