$(document).ready(function(){
var y = 600;
var x = 0;
var x_pared = [0,    0,100,100,100,200,200,300,300,300,300,300,300,300,400,500,500,500,700,600,600,600];
var y_pared = [100,500,300,500,600,100,300,0,  100,200,300,400,500,600,400,100,300,600,  0,200,400,700];
var x_ene = 400;
var y_ene = 700;
var interval_id = setInterval(function() { cambiarPosicionEne(); },3000);
var check = 0;
var p = 0;

function randomPosicionEnemigo(){
    x_ene = Math.floor(Math.random()*8)*100;
    y_ene = Math.floor(Math.random()*8)*100;
}

function cambiarPosicionEne(){
	randomPosicionEnemigo();
	for(k=0;k<22;k++){
	if(x_ene==x_pared[k] && y==y_pared[k]){
		cambiarPosicionEne();
	}else{
		$("#ene").css({"top": y_ene + "px"});
		$("#ene").css({"left": x_ene + "px"});
		}
	}
}

function detectarColision(){
	check = 0;
 for(i=0;i<22;i++){
  if(x==x_pared[i] && y==y_pared[i]){
   check = 1;
  }
 }
 }
 
 function empezarBatalla(){
 if(x==x_ene && y==y_ene){
	location.href='battle.html';
  } 
 }

 
$("body").keypress(function(e) {
    if (e.which == 115) {
       //DOWN -S
        y = y +100;
        if(y > 700) y =700;
	detectarColision();
	empezarBatalla();
	if(check==1){
		y=y-100;}
		$("#personaje").css({"top": y + "px"});
    }
    if (e.which == 119) {
       //UP - W
        y = y - 100;
        if(y < 0 ) y = 0;
    empezarBatalla();   
	detectarColision();
	if(check==1){
		y=y+100;}
		$("#personaje").css({"top": y + "px"});
    }
 
    if (e.which == 100) {
       //RIGHT - D
        x = x + 100;
        if(x > 700 ) x = 700;
    empezarBatalla();    
	detectarColision();
	if(check==1){
		x=x-100;}
		$("#personaje").css({"left": x + "px"});
 
    }                                           
    if (e.which == 97) {
       //LEFT - A
        x = x - 100;
        if(x < 0) x = 0;
    empezarBatalla();   
	detectarColision();
	if(check==1){
		x = x + 100;}
		 $("#personaje").css({"left": x + "px"});
    }
 
	});
});
