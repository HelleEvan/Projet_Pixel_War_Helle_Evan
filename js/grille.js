
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
    let position =0;
    pixels.forEach(pixel => {
        colors_display.forEach(color =>{
            pixel.addEventListener("click",()=>{
                position ++;
                if(color.classList.contains("red")&&color.classList.contains("active")){
                    rm_color(pixel);
                    pixel.classList.add("red");
                    grille_save(pixel,position);
                }
                if(color.classList.contains("green")&&color.classList.contains("active")){
                    rm_color(pixel);
                    pixel.classList.add("green");
                    grille_save(pixel,position);
                }
                if(color.classList.contains("blue")&&color.classList.contains("active")){
                    rm_color(pixel);
                    pixel.classList.add("blue");
                    grille_save(pixel,position);
                }
                
                
            });
        });
    });
}
window.addEventListener("load",color());

function rm_color(pixel){
    if(pixel.classList.contains("red")){
        pixel.classList.remove("red");
    }
    else if(pixel.classList.contains("green")){
        pixel.classList.remove("green");
    }
    else if(pixel.classList.contains("blue")){
        pixel.classList.remove("blue");
    }
}
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

function grille_save(pixel,position){

    const couleur =pixel.classList;
    console.log(couleur,position);
        
}