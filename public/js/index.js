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
        {
            checkedRubriques.push(val);
            elt.style.backgroundColor = 'lightblue';
        }
        else
        {
            checkedRubriques.splice(checkedRubriques.indexOf(val), 1);
            elt.style.backgroundColor = '';
        }
    }

    let vars = {
        categories: checkedRubriques,
        favOnly: document.getElementById("favOnly").checked,
        filter: document.getElementById('search').value
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
        let albumList = document.getElementById('albumList');
        albumList.innerHTML = '';

        if (msg.length > 0)
            for (let a of msg)
                albumList.innerHTML += getProduct(a.id, a.titre, a.titre, a.descriptif, a.photo, a.isFav);
        else
            albumList.innerHTML = noProduct();
    });
}

noProduct = () => {
    return `<div class="col-sm-6 col-lg-6 col-md-6">
                <h2>Pas de produits dans la base de données</h2>
            </div>`;
}

getProduct = (album_id, name, short_name, description, img_url, isFavori) => {
    return (`
    <td style="height:30%;width:30%">
        <div class="col-sm-4 col-lg-4 col-md-4 recipeBox" style="width:100%">
            <div class="thumbnail">
                <img src="public/img_cover/${img_url}" alt="" style="height:20%">
                <div class="caption" data-toggle="tooltip" title="${name}">
                    <h4><a href="./detail.php?id=${album_id}">${short_name}</a></h4>
                    <p>${description}</p>
                </div>
                <div class="ratings">
                <p style="text-align: right;">
                    <span onclick="addFavori(${album_id})" id="addFav_${album_id}" title="Favoris" style="font-size: 24px; color: ` + (Number(isFavori) ? 'red;' : 'lightgrey;') + `">
                        <i class="fa fa-heart"></i>
                    </span>
                    <span>
                        <a href="#" class="addPan" onclick="addPanier(${album_id})">Ajouter au panier</a></p>
                    </span>
                    </p>
                </div>
            </div>
        </div>
    </td>`);
}


/**
 * Ajoute au favoris le param e
 * @param e
 */
let addFavori = (e) => {
    fetch('Actions/UpdateFavoris.php', {
        method: "POST",
        body: JSON.stringify({id_produit: e}),
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    }).then(r => {
        return r.json();
    }).then((msg) => {
        let obj = document.getElementById('addFav_' + e);
        obj.style.color = (obj.style.color === 'red' ? 'lightgrey' : 'red');
        if (msg.state)
            success("Mise à jour des favoris effectuée avec succès !");
        else
            error("Veuillez réessayer ultérieurement ...");
    });
}



ready(() => {
    let elements = document.getElementsByClassName('rubrique');
    for (let i = 0; i < elements.length; i++)
        elements[i].addEventListener('click', () => requestAlbumList(elements[i]));

    document.getElementById("favOnly").addEventListener('click', requestAlbumList, false);

    document.getElementById('search').addEventListener('keypress', (e) => {
        if (e.code === 'Enter')
            requestAlbumList();
    });

    setTimeout(requestAlbumList, 50);
});