const abrirModal = document.querySelector('.verCarrito');
const modal = document.querySelector('.modal-pasarela');
const cerrarModal = document.querySelector('.cerrar')

function mostrarModal(){
	modal.classList.add('vermodal');
}

cerrarModal.addEventListener("click", (e)=>{

	e.preventDefault;
	modal.classList.remove('vermodal');
} )

// abrirModal.addEventListener('onclick', (e)=>{
// 	e.preventDefault();
// 	modal.classList.add('vermodal');
// })

// cerrarModal.addEventListener('onclick', (e)=>{
// 	e.preventDefault();
// 	modal.classList.remove('vermodal');
// })