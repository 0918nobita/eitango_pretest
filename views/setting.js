var display  = document.getElementById('display');
var method   = document.getElementById('method');
var order    = document.getElementById('order');
var quantity = document.getElementById('quantity');
var button   = document.settings.lastElementChild;
document.settings.display.addEventListener("click", function() {
    var selectorElement = document.settings.display;
    var index = selectorElement.selectedIndex;
    var selectedOption = selectorElement.options[index].value;
    switch (selectedOption) {
        case "non-selected":
            method.style.display   = "none";
            order.style.display    = "none";
            quantity.style.display = "none";
            button.style.display   = "none";
            break;
        default:
            method.style.display   = "block";
            order.style.display    = "none";
            quantity.style.display = "none";
            button.style.display   = "none";
            document.settings.method.dispatchEvent(new Event('click'));
            break;
    }
});
document.settings.method.addEventListener("click", function() {
    var selectorElement = document.settings.method;
    var index = selectorElement.selectedIndex;
    var selectedOption = selectorElement.options[index].value;
    switch (selectedOption) {
        case "non-selected":
            order.style.display    = "none";
            quantity.style.display = "none";
            button.style.display   = "none";
            break;
        default:
            order.style.display    = "block";
            quantity.style.display = "none";
            button.style.display   = "none";
            document.settings.order.dispatchEvent(new Event('click'));
            break;
    }
});
document.settings.order.addEventListener("click", function() {
    var selectorElement = document.settings.order;
    var index = selectorElement.selectedIndex;
    var selectedOption = selectorElement.options[index].value;
    switch (selectedOption) {
        case "non-selected":
            quantity.style.display = "none";
            button.style.display   = "none";
            break;
        case "num":
            quantity.style.display = "none";
            button.style.display = "block";
            break;
        default:
            quantity.style.display = "block";
            button.style.display = "block";
            break;
    }
});
