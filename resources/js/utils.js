const badge_spinner = "<span class='spinner spinner-border'></span>";

const popup_container = document.querySelector(".popup-container");
const popup_body = document.querySelector(".popup");
const popup_icon = document.querySelector(".popup-icon > i");
const popup_msg = document.querySelector(".popup-message");

const loadingscreen = document.querySelector(".loadingscreen-container");
const span = document.querySelector(".loadingscreen_points");
let utils_compteur = 0, utils_loadingscreen_interval;

/**
 * Executes a function repeatedly at a specified interval.
 *
 * @param {number} interval - The interval, in milliseconds, at which the function should be executed.
 * @return {undefined} This function does not return a value.
 */
function utils_Interval(){
    utils_loadingscreen_interval = setInterval(function(){
        span.innerText += ".";
        utils_compteur++;
        if (utils_compteur == 4){
            utils_compteur = 0;
            span.innerText = "";
        }
    }, 1000)
}

if (loadingscreen){
    window.addEventListener("DOMContentLoaded", function(){
        loadingscreen.classList.add("hidden");
        span.innerText = "";
        clearInterval(utils_loadingscreen_interval);
    })
    
    window.addEventListener("beforeunload", function(){
        loadingscreen.classList.remove("hidden");
        span.innerText = "";
        utils_Interval();
    })
}

/**
 * Sends a POST request to the specified URL with the given data and returns the response as JSON.
 *
 * @param {string} url - The URL to send the request to.
 * @param {object} d - The data to include in the request body.
 * @return {Promise} A Promise that resolves to the response as JSON.
 */
function fetch_result(url, d){
    return fetch(url, {
        method: "POST",
        headers: {
            "Content-type" : "application/json"
        },
        body: JSON.stringify(d)
    }).then(response => {
        return response.json();
    }).then(result => {
        return result;
    }).catch(error => {
        return error;
    });
}

/**
 * Toggle the button click event.
 *
 * @param {HTMLElement} target - The target element to toggle.
 * @param {number} c - The value to determine the toggle action. 1 for showing a spinner and reducing opacity, -1 for restoring initial content and opacity.
 * @param {string} initialContent - The initial content of the target element.
 */
function toggleButtonClick(target, c, initialContent){
    if (c == 1){
        target.innerHTML = badge_spinner;
        target.style.opacity = "0.7";
    } else if (c == -1){
        target.innerHTML = initialContent;
        target.style.opacity = "1";
    }
}

/**
 * Applies a popup effect with the specified color, icon, and message.
 *
 * @param {string} color - The color of the popup.
 * @param {string} icon - The icon to display in the popup.
 * @param {string} msg - The message to display in the popup.
 */
function do_popup(color, icon, msg){
    popup_container.style.bottom = "10px";
    popup_icon.classList.add(icon);
    popup_body.classList.add(color);
    popup_msg.innerText = msg;

    setTimeout(() => {
        popup_container.style.bottom = "-100vh";
        popup_icon.classList.remove(icon);
        popup_body.classList.remove(color);
        popup_msg.innerText = "";
    }, 2000);
}

export {fetch_result, toggleButtonClick, do_popup}