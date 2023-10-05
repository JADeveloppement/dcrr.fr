const badge_spinner = "<span class='spinner spinner-border'></span>";

const popup_container = document.querySelector(".popup-container");
const popup_body = document.querySelector(".popup");
const popup_icon = document.querySelector(".popup-icon > i");
const popup_msg = document.querySelector(".popup-message");

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

function toggleButtonClick(target, c, initialContent){
    if (c == 1){
        target.innerHTML = badge_spinner;
        target.style.opacity = "0.7";
    } else if (c == -1){
        target.innerHTML = initialContent;
        target.style.opacity = "1";
    }
}

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