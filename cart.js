var removeCartItemButtons= document.getElementByClassName('btn-danger')
console.log(removeCartItemButtons)
for(var i=0; i < removeCartItemButtons.length; i++){
	var button = removeCartItemButtons[i]
	button.addEventListener('click',function(event){
		var buttonClicked = event.target
		buttonClicked.parentElement.parentElement.remove()
		updateCartTotal()
	})
}
function updateCartTotal(){
	var shopItemContainer = document.getElementByClassName('shop-item')[0]
	var shopRows = shopItemContainer.getElementByClassName('shop-row')
	for (var i=0; i < shopRows.length; i++){
		var shopRow = shopRows[i]
		var priceElement = shopRow.getElementByClassName('shop-price')[0]
		var quantityElement = shopRow.getElementByClassName('shop-quantity-input')[0]
		console.log(priceElement,quantityElement)
	}
}