$(".counter-plus").click(function (e) {
    let Quantity = $(e.currentTarget).siblings("#Quantity");
    let QuantityValue = parseInt(Quantity.val()) + 1;
    if (QuantityValue >= 10) {
        QuantityValue = 10;
    }
    Quantity.val(QuantityValue);
});
$(".counter-minus").click(function (e) {
    let Quantity = $(e.currentTarget).siblings("#Quantity");
    let QuantityValue = parseInt(Quantity.val()) - 1;
    if (QuantityValue < 0) {
        QuantityValue = 0;
    }
    Quantity.val(QuantityValue);
});

