var LazyLoad = require("vanilla-lazyload");

function getChildrenHeight(element) {
    var height = 0;

    for (var i = 0; i < element.children.length; ++i)
        height += element.children[i].offsetHeight;

    return height;
}

function openMenu() {
    var navigationMenu = document.getElementById("navigation");
    var isActive = navigationMenu.classList.contains("navigation-opened");

    if (isActive) {
        navigationMenu.classList.remove("navigation-opened");
        navigationMenu.style.height = "0";
    }
    else {
        navigationMenu.classList.add("navigation-opened");
        updateNavigationMenu();
        navigationMenu.style.height = getChildrenHeight(navigationMenu) + "px";
    }

    var buttons = document.querySelectorAll(".header .navigation-button-mobile");

    for (var i = 0; i < buttons.length; ++i) {
        if (isActive)
            buttons[i].classList.remove("navigation-opened");
        else
            buttons[i].classList.add("navigation-opened");
    }
}

function updateNavigationMenu() {
    var navigationMenu = document.getElementById("navigation");

    if (navigationMenu.classList.contains("navigation-opened"))
        navigationMenu.classList.add("navigation-show");
    else
        navigationMenu.classList.remove("navigation-show");
}

function init() {
    var buttons = document.querySelectorAll(".header .navigation-button-mobile");

    for (var i = 0; i < buttons.length; ++i)
        buttons[i].addEventListener("click", openMenu);

    var navigationMenu = document.getElementById("navigation");

    if (navigationMenu)
        navigationMenu.addEventListener("transitionend", updateNavigationMenu);

    new LazyLoad({
        elements_selector: ".lazy"
    });
}

document.addEventListener("DOMContentLoaded", init);
