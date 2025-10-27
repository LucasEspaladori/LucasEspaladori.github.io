function splitAtRoot(path) {
    const url = new URL(path, location.origin);
    const pathFromRoot = url.pathname;
    return pathFromRoot;
}

function setNav(current_path) {

    fetch("nav.html")
        .then(r => r.text())
        .then(html => {
            document.getElementById("main-nav").innerHTML = html;
            current_path = splitAtRoot(current_path);
            console.log("current page:" + current_path)

            let nav_ul = document.getElementById("nav_ul");

            for (let li of nav_ul.children) {
                child = li.children[0];
                if (child instanceof HTMLAnchorElement) {
                    console.log("Child link: " + child.href)
                    if(splitAtRoot(child.href) === current_path){
                        child.classList.add("current_page")
                    }

                    const link_path = splitAtRoot(child.href);

                    if (link_path === current_path) {
                        console.log("Got it")
                        child.classList.add("current_page"); 
                    }

                    if((current_path === "/LucasEspaladori.github.io/index.html" && "/LucasEspaladori.github.io/") &&
                        child.href === "/LucasEspaladori.github.io/index.html"){
                        console.log("Home too because split at root is" + splitAtRoot(child.href))
                        child.classList.add("current_page")
                    }
                }
            }
        })
}