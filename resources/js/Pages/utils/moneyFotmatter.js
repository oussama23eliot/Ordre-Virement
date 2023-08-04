

export function handleMoneyInput(money) {
    let num = money.replace(/[^0-9.]/g, "");
    return parseFloat(num);
}

export function handleInput2(montant) {
    montant = montant.toLocaleString("en-US", {
        currencySign: "standard",
        style: "currency",
        currency: "MAD",
    })
    return montant;
}