function toggleModal () {
    let modal = document.getElementById("modal-overlay");
    modal.classList.toggle("open");
}

document.getElementById("modalBtn").addEventListener("click", toggleModal);

document.getElementById("modal-exit").addEventListener("click", toggleModal);


