document.addEventListener("DOMContentLoaded", () => {
    let menuIcon = document.querySelector(".menuicn");
    let nav = document.querySelector(".navcontainer");
  
    menuIcon.addEventListener("click", () => {
        nav.classList.toggle("navclose");
    });
  
    document.addEventListener("click", (event) => {
        const isNavContainer = event.target.closest(".navcontainer");
        const isMenuIcon = event.target.closest(".menuicn");
  
        if (!isNavContainer && !isMenuIcon) {
            nav.classList.add("navclose");
        }
    });
  });
  