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

function color_choice(){
    const colors_display = Array.from(document.querySelectorAll("color"));
    colors_display.forEach(color => {
            color.addEventListener("click",()=>{
                if(!color.classList.contains("active")){
                    try{
                        document.querySelector("color.active").classList.remove("active");
                    }
                    finally{
                        color.classList.add("active");
                    }
                }
            });
    });
}
window.addEventListener("load",color_choice());