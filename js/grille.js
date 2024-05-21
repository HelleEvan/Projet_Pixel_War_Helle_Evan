function generateGrille(){
    const grille = document.querySelector("pixels");

    for(let i=0;i<900;i++){
        const pixel = document.createElement("pixel");
        grille.appendChild(pixel);
    }

}
window.addEventListener("load",generateGrille());

function color(){
    const pixels = Array.from(document.querySelectorAll("pixel"));
    pixels.forEach(pixel => {
        pixel.addEventListener("click",()=>{
            pixel.classList.add("red");
        });
    });
}
window.addEventListener("load",color());