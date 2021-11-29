function ready(callback) {
    if (document.readyState !== 'loading') callback();
    else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
    else document.attachEvent('onreadystatechange', function () {
            if (document.readyState == 'complete') callback();
        });
}

var checkedRubriques = [];

/**
 * Mets à jour les albums affichés en fonction des différents filtres
 * @param elt
 */
requestAlbumList = (elt) => {
    if (elt != null) {
        let val = elt.getAttribute('idrub');
        if (!checkedRubriques.includes(val))
            checkedRubriques.push(val);
        else
            checkedRubriques.splice(checkedRubriques.indexOf(val), 1);
    }

    let vars = {
        categories: checkedRubriques,
        favOnly: document.getElementById("favOnly").checked,
        filter: document.getElementById('search').innerText
    }

    fetch('Actions/getAlbumList.php', {
        method: "POST",
        body: JSON.stringify(vars),
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    }).then((r) => {
        return r.json();
    }).then((msg) => {
        console.log(msg);
        document.getElementById('albumList').innerHTML = msg;
    });
}

/**
 * Ajoute au favoris le param e
 * @param e
 */
let addFav = (e) => {
    $.ajax({
        method: "POST",
        url: "EnregFav.php",
        data: {id_produit: e},
        success: function (data) {
        },
    });

}


/**
 * Ajoute au panier le param e
 * @param e
 */
let addPanier = (e) => {
    $.ajax({
        type: 'POST',
        url: 'fonctions/fonctionsPanier.php',
        data: {item: e},
        success: function (data) {
            alert(data);
        },
    });
}


ready(() => {
    let elements = document.getElementsByClassName('rubrique');
    for (let i = 0; i < elements.length; i++)
        elements[i].addEventListener('click', () => requestAlbumList(elements[i]));
    document.getElementById("favOnly").addEventListener('click', requestAlbumList, false);
    $('#toolt').tooltip();
    setTimeout(requestAlbumList, 50);
});