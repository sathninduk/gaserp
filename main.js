const inputs=document.querySelectorAll('.input');

function focusFunc(){
	let parent=this.parentNode.parentNode;
	parent.classList.add('focus');
}
inputs.forEach(input=>{
	input.addEventListener('focus',focusFunc);
});