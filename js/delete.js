window.addEventListener("load", (event) => {
    let linkTo="";
    const delBtns = document.querySelectorAll("[data-delete]");
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    for(let i=0;i<delBtns.length; i++) {
        delBtns[i].onclick = function(e) {
            e.preventDefault();
            linkTo = this.href;
            console.log("Link to", linkTo);
            deleteModal.show();
        }
    }
    //натиснули на кнопку видалити у модалці
    document.getElementById("modalDeleteYes").onclick = function() {
        axios.post(linkTo).then(resp => {
            deleteModal.hide();
            location.reload();
        });
    }
});