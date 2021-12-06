function ready(callback) {
    if (document.readyState !== 'loading') callback();
    else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
    else document.attachEvent('onreadystatechange', function () {
            if (document.readyState == 'complete') callback();
        });
}

panierLayout = (result) => {
    let tableStart = `<table>
            <tr>
                <td width=100px></td>
                <td width='50px'>ID</td>
                <td width='250px'>Titre</td>
                <td width='80px'>Prix</td>
                <td width='80px'>Quantité</td>
            </tr>
            <tr>
                <td colspan='3'><hr></td>
            </tr>`;
    let tableEnd = `</table>`;

    let isLogged = result.cookies === undefined;
    return `${tableStart} ${result.panier.map(item => {
        return `<tr>
                    <td>
                        <button onclick="removePanier(${item.id})">Effacer</button>
                    </td>
                    <td>${item.id}</td>
                    <td>${item.titre}</td>
                    <td>${item.prix}</td>
                    <td>` + (isLogged ? item.amount : result.cookies[item.id]) + `</td>
                </tr>`;
    }).join(' ')} ${tableEnd}`;
}

removePanier = async (p) => {
    fetch((window.location !== '/' ? '../' : '') + 'Cart/UpdatePanier.php', {
        method: "POST",
        body: JSON.stringify({
            album: p,
            amount: 0
        }),
        headers: {
            'Content-Type': 'application/json',
        }
    });
    location.reload();

}

ready(() => {
    fetch('/Cart/getCart.php', {
        method: "POST",
        headers: {
            'Accept': 'application/json'
        }
    }).then((r) => {
        return r.json()
    }).then((result) => {
        let panier = document.getElementById('panier');
        if (result.panier.length <= 0)
            panier.innerHTML = `<p>Votre panier est vide</p>`;
        else
            panier.innerHTML = panierLayout(result, (result.cookies !== undefined));
    });
})
