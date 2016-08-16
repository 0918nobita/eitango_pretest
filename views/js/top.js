$("input"). keydown(function(e) {
    if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
        return false;
    } else {
        return true;
    }
});
var answer_method  = document.getElementById('answer_method');
var method   = document.getElementById('method');
var order    = document.getElementById('order');
var quantity = document.getElementById('quantity');
var button   = document.settings.lastElementChild;
document.settings.answer_method.addEventListener("change", function() {
    var selectorElement = document.settings.answer_method;
    var index = selectorElement.selectedIndex;
    var selectedOption = selectorElement.options[index].value;
    switch (selectedOption) {
        case "non-selected":
            method.style.display   = "none";
            order.style.display    = "none";
            quantity.style.display = "none";
            button.style.display   = "none";
            break;
        case "type":
            document.settings.method.options[1].setAttribute("disabled", "");
            document.settings.method.options[2].setAttribute("selected", "");
            if (document.settings.method.value == "eitango-imi") document.settings.method.value = "imi-eitango";
            method.style.display   = "block";
            order.style.display    = "none";
            quantity.style.display = "none";
            button.style.display   = "none";
            document.settings.method.dispatchEvent(new Event('change'));
            break;
        case "touch":
            document.settings.method.options[1].removeAttribute("disabled");
            method.style.display   = "block";
            order.style.display    = "none";
            quantity.style.display = "none";
            button.style.display   = "none";
            document.settings.method.dispatchEvent(new Event('change'));
            break;
    }
});
document.settings.method.addEventListener("change", function() {
    var selectorElement = document.settings.method;
    var index = selectorElement.selectedIndex;
    var selectedOption = selectorElement.options[index].value;
    switch (selectedOption) {
        case "non-selected":
            order.style.display    = "none";
            quantity.style.display = "none";
            button.style.display   = "none";
            break;
        /*case "eitango-imi":
         document.settings.answer_method.value = "touch";*/
        default:
            order.style.display    = "block";
            quantity.style.display = "none";
            button.style.display   = "none";
            document.settings.order.dispatchEvent(new Event('change'));
            break;
    }
});
document.settings.order.addEventListener("change", function() {
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
document.settings.answer_method.dispatchEvent(new Event("change"));
