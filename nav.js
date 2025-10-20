function splitAtRoot(path) {
    const url = new URL(path, location.origin);
    const pathFromRoot = url.pathname;
    return pathFromRoot;
}

function setNav(current_path) {
    current_path = splitAtRoot(current_path);

    fetch("nav.html")
        .then(r => r.text())
        .then(html => {
            document.getElementById("main-nav").innerHTML = html;
            const nav = document.getElementById("main-nav");
            const links = nav.querySelectorAll('a');

            for (let child of links) {
                if (child instanceof HTMLAnchorElement) {
                    const link_path = splitAtRoot(child.href);
                    if (link_path === current_path) {
                        child.classList.add("current_page"); 
                    }
                }
            }
        })
        .catch(e => {});
}