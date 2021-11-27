$().ready(function () {
    $("input[name=selection]").each(function (i, selected) {
        selected.addEventListener('click', requestAlbumList, false);
    });
    document.getElementById("favOnly").addEventListener('click', requestAlbumList, false);

    $("#addPan").click((e) => {
        this.preventDefault();
    });

    $('#toolt').tooltip();

    setTimeout(requestAlbumList, 50);
});

var ingrList;

function requestAlbumList() {
    ingrList = [];
    $("input[name=selection]:checked").each(function (i, selected) {
        ingrList.push(selected.value);
    });
    $.ajax({
        method: "POST",
        url: "getAlbumList.php",
        data: {ingr: ingrList, favOnly: document.getElementById("favOnly").checked, mot: $("#search").val()}
    })
        .done(function (msg) {
            $("#albumList").html(msg);
            addEvents();
        });
}

function addFav(e) {
    $.ajax({
        method: "POST",
        url: "EnregFav.php",
        data: {id_produit: e},
        success: function (data) {
        },
    });

}

function addPanier(e) {
    $.ajax({
        type: 'POST',
        url: 'fonctions/fonctionsPanier.php',
        data: {item: e},
        success: function (data) {
            alert(data);
        },
    });
}

