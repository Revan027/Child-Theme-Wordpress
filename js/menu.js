/************************** CIBLAGE DANS LE DOM *************************/
let categMenu = document.getElementsByClassName('categMenu');
let categMenuResponsive = document.querySelector(".categ-menu-responsive");
let nav = document.getElementById('access');
let menu = document.getElementsByClassName('hidden-menu');
let bufferElement = null;


/**************************  EVENTS  *************************/
/* mise en place des event lié au click sur les categories*/
for(let i = 0; i < categMenu.length; i++ ){
    categMenu[i].addEventListener("click",displayCateg);
}

menu[0].addEventListener("click",displayMenuResponsive);

/* ecoute si event sur l'event resize*/
window.addEventListener("resize",function(){
    categMenuResponsive.style.display = "none";
    menu.className = "hidden-menu";
    
});



/************************** AFFICHE/CACHE LE SOUS MENU *************************/
function displayCateg(){
   
     var listUl = $(".categ-menu-responsive").find("ul");
     var ul = $(this).find("ul");

      if(bufferElement!=null && bufferElement.parent().attr("id")  != $(ul).parent().attr("id")){
            $(bufferElement).attr("class",'categMenu');             
            $(bufferElement).css("animationName","hiddenMenuResize");
            $(bufferElement).css("animationDuration","2s");
            marginMenu($(bufferElement)); 
      }

      if(ul.attr("class") === 'categMenu active'){
            $(ul).attr("class",'categMenu');             
            $(ul).css("animationName","hiddenMenuResize");
            $(ul).css("animationDuration","2s");
            marginMenu(ul);
      }else{
            $(ul).css("display",'block');    
            $(ul).attr("class",'categMenu active');             
            $(ul).css("animationName","displayMenuResize");
            $(ul).css("animationDuration","2s");
            marginMenu(ul); 
            bufferElement = $(ul);
      }    
      
}



/************************** GESTION DE LA MARGE DU CONTENU POUR LE SOUS MENU *************************/
function marginMenu(element){
    let margin = 0;
    var heightUl = element.height();
    
    if(element.attr('class') == "categMenu active"){
        margin = heightUl+5;
    }
    
    element.parent().animate({  //cherche le parent de la classe
        marginBottom:margin
      },1000, function() {
        // Animation complete.
      });
}
  



/************************** AFFICHE/CACHE LE MENU  *************************/
function displayMenuResponsive(){
    /* remise par default des attribut pour éviter a la recréation de l'objet une animation */
    
    let elementUl = document.querySelectorAll(".categMenu ul");

    for(var item of elementUl){
        item.style.animationName ='';      
        item.className = 'categMenu'; 
        var parentNode = item.parentNode;
        parentNode.style.marginBottom ="0px";
    }
    
    if( menu.className == "hidden-menu active"){
        categMenuResponsive.style.display = 'none'; 
        menu.className = "hidden-menu";
    }else{
        categMenuResponsive.style.display = 'block'; 
        menu.className = "hidden-menu active";
    } 
}


/**************************  displaying menu if rezize *************************/
/*function displayMenuResize(){
    let width =  screen.width;
       
    if( width <= 572){
        displayMenuResponsive();
    }
}*/

