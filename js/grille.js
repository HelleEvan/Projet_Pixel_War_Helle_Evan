function generateGrille(){
    const grille = document.querySelector("pixels");

    for(let i=0;i<900;i++){
        const pixel = document.createElement("pixel");
        grille.appendChild(pixel);
    }

}
window.addEventListener("load",generateGrille());
//changer la couleur d'un pixel
function color(){
    const pixels = Array.from(document.querySelectorAll("pixel"));
    const colors_display = Array.from(document.querySelectorAll("color"));
    pixels.forEach(pixel => {
        colors_display.forEach(color =>{
            pixel.addEventListener("click",()=>{
                if(color.classList.contains("red")&&color.classList.contains("active")){
                    pixel.classList.add("red");
                }
                if(color.classList.contains("green")&&color.classList.contains("active")){
                    pixel.classList.add("green");
                }
                if(color.classList.contains("blue")&&color.classList.contains("active")){
                    pixel.classList.add("blue");
                }
            });
        });
    });
}
window.addEventListener("load",color());
//selection de couleur
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