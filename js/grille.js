
function generateGrille(){
    const grille = document.querySelector("pixels");

    for(let i=1;i<901;i++){
        const pixel = document.createElement("pixel");
        pixel.classList.add("white");
        pixel.id=i;
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
                        rm_color(pixel);
                        pixel.classList.add("red");
                        grille_save();
                    }
                    else if(color.classList.contains("green")&&color.classList.contains("active")){
                        rm_color(pixel);
                        pixel.classList.add("green");
                        grille_save();    
                    }
                    else if(color.classList.contains("blue")&&color.classList.contains("active")){
                        rm_color(pixel);
                        pixel.classList.add("blue");
                        grille_save();
                    }
                    pixels.forEach(p => p.classList.add("not-allowed"));
                    setTimeout(()=>{
                        pixels.forEach(p => p.classList.remove("not-allowed"));
                        pixel.classList.add("not-allowed");
                        setTimeout(()=>{
                            pixel.classList.remove("not-allowed")
                        },15000);
                    },15000);
                    
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
    else if(pixel.classList.contains("white")){
        pixel.classList.remove("white");
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

function grille_save(){
    const couleurs = [];
    const positions = [];
    const grille = Array.from(document.querySelectorAll("pixel"));
    grille.forEach(pixel => {
        couleurs.push(Array.from(pixel.classList));
        positions.push(pixel.id);
        
    });
    //console.log(couleurs,positions);
    fetch('../php/grille.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
            position: positions,
            couleur: couleurs,
            
        })
    })
}

window.addEventListener("load",grille_save());