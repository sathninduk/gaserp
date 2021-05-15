if(document.readyState == 'loading'){
	document.addEventListener('DOMContentLoaded', ready)
}else{
	ready()
}
function ready(){
	var removeCartItemButtons = document.getElementsByClassName('btn-danger')
		for (var i = 0; i < removeCartItemButtons.length; i++){
			var button = removeCartItemButtons[i]
			button.addEventListener('click', removeCartItem)
	}
	var quantityInputs = document.getElementsByClassName('shop-quantity-input')
		for(var i =0; i < quantityInputs.length; i++){
			var input = quantityInputs[i]
			input.addEventListener('change', quantityChanged)
	}
	var addToCartButtons = document.getElementsByClassName('cart-item-button')
		for(var i = 0; i < addToCartButtons.length; i++){
			var button = addToCartButtons[i]
			button.addEventListener('click', addToCartClicked)
		}
	document.getElementsByClassName('btn-purchase')[0].addEventListener('click',purchaseClicked)
}
 function purchaseClicked(){
	 alert('Thank you for your purchase')
	 var shopItems = document.getElementsByClassName('shop-items')[0]
	 while(shopItems.hasChildNodes()){
		 shopItems.removeChild(shopItems.firstChild)
	 }
	 updateCartTotal()
 }

function removeCartItem(event){
	var buttonClicked = event.target
	buttonClicked.parentElement.parentElement.remove()
	updateCartTotal()
}

function quantityChanged(event){
	var input = event.target
	if(isNaN(input.value) || input.value <= 0){
		input.value = 1
	}
	updateCartTotal()
}

function addToCartClicked(event){
	var button = event.target
	var cartItem = button.parentElement.parentElement
	var title = cartItem.getElementsByClassName('cart-item-title')[0].innerText
	var price = cartItem.getElementsByClassName('cart-item-price')[0].innerText
	var imageSrc = cartItem.getElementsByClassName('cart-item-image')[0].src
	addItemToCart(title,price,imageSrc)
	updateCartTotal()
}
function addItemToCart(title,price,imageSrc){
	var shopRow = document.createElement('div')
	shopRow.classList.add('shop-row')
	var shopItems = document.getElementsByClassName('shop-items')[0]
	var shopItemNames = shopItems.getElementsByClassName('shop-item-title')
	for(var i = 0; i < shopItemNames.length; i++){
		if(shopItemNames[i].innerText == title){
			alert('This item is already added to the cart')
			return
		}
	}
	var shopRowContents = `
		<div class="shop-item shop-column">
			<img class="shop-item-image" src="${imageSrc}" width="100" height="100">
			<span class="shop-item-title">${title}</span>
		</div>
		<span class="shop-price shop-column" >${price}</span>
		<div class="shop-quantity shop-column">
			<input class="shop-quantity-input" type="number" value="1">
			<button class="btn btn-danger" type="button" > REMOVE</button>
		</div>`
	shopRow.innerHTML = shopRowContents
	shopItems.append(shopRow)
	shopRow.getElementsByClassName('btn-danger')[0].addEventListener('click',removeCartItem)
	shopRow.getElementsByClassName('shop-quantity-input')[0].addEventListener('change',quantityChanged)
	
}
//to update the total of our cart every time 

function updateCartTotal(){
	var shopItemContainer = document.getElementsByClassName('shop-items')[0]
	var shopRows = shopItemContainer.getElementsByClassName('shop-row')
	var total =0;
	for (var i = 0; i < shopRows.length; i++){
		var shopRow = shopRows[i]
		var priceElement = shopRow.getElementsByClassName('shop-price')[0]
		var quantityElement = shopRow.getElementsByClassName('shop-quantity-input')[0]
		var price = parseInt(priceElement.innerText.replace('Rs',''))
		var quantity = quantityElement.value
		total = total + (price * quantity)
	}
	total = Math.round(total * 100)/100
	document.getElementsByClassName('shop-total-price')[0].innerText = 'Rs' + total + '.00'
}