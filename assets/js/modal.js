const abrirModal = document.querySelector('.verCarrito');
const modal = document.querySelector('.modal');
const cerrarModal = document.querySelector('.cerrar')

abrirModal.addEventListener('click', (e)=>{
	e.preventDefault();
	modal.classList.add('vermodal');
})

cerrarModal.addEventListener('click', (e)=>{
	e.preventDefault();
	modal.classList.remove('vermodal');
})