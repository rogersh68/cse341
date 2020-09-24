function populate(id) {
    var divId = id + "-output";
    var div = document.getElementById(divId);

    if (div.classList.contains('hide')) {
        div.classList.add('output');
        div.classList.remove('hide');
    }
    else {
        div.classList.add('hide');
        div.classList.remove('output');
    }

    changeText(id);
}

function changeText(id) {
    var a = document.getElementById(id);
    switch (id) {
        case 'location':
            if (a.innerHTML == "+ Where I am From") {
                a.innerHTML = "x Where I am From";
            }
            else {
                a.innerHTML = "+ Where I am From";
            }
            break;
        case 'food':
            if (a.innerHTML == "+ My Favorite Food") {
                a.innerHTML = "x My Favorite Food";
            }
            else {
                a.innerHTML = "+ My Favorite Food";
            }
            break;
        case 'major':
            if (a.innerHTML == "+ My Major") {
            a.innerHTML = "x My Major";
            }
            else {
                a.innerHTML = "+ My Major";
            }
            break;
        case 'hobbies':
            if (a.innerHTML == "+ My Hobbies") {
                a.innerHTML = "x My Hobbies";
            }
            else {
                a.innerHTML = "+ My Hobbies";
            }
            break;
        case 'countries':
            if (a.innerHTML == "+ Countries I've Been To") {
                a.innerHTML = "x Countries I've Been To";
            }
            else {
                a.innerHTML = "+ Countries I've Been To";
            }
            break;
        case 'family':
            if (a.innerHTML == "+ My Family") {
                a.innerHTML = "x My Family";
            }
            else {
                a.innerHTML = "+ My Family";
            }
            break;
    }
}