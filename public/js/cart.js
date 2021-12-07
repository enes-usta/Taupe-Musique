
error = (text) => {
    let res = document.getElementById('NotifyResult');
    res.innerText = text;
    res.className = 'w-100 bg-danger';
    setTimeout(() => {
        res.innerText = ''
    }, 5000)
}

success = (text) => {
    let res = document.getElementById('NotifyResult');
    res.innerText = text;
    res.className = 'w-100 bg-success';
    setTimeout(() => {
        res.innerText = ''
    }, 5000)
}

/**
 * Ajoute au panier le param e
 * @param e
 */
let addPanier = (e) => {
    fetch('Cart/UpdatePanier.php', {
        method: "POST",
        body: JSON.stringify({album: e, amount: 1}),
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    }).then(r => {
        return r.json();
    }).then((msg) => {
        if (msg.state)
            success("Produit ajouté au panier avec succès !");
        else
            error("Erreur lors de l'ajout du produit au panier ...");
    });
}