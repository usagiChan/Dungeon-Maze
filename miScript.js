$(document).ready(function(){
	


				var pjnum = <?php echo "$pj";?>;
				
				//conseguir imagen
				var pjsrc = "images/0"+pjnum+".png"; 		
				document.personaje.src= pjsrc;
				
				//conseguir atributos
				function personaje(ataque, defensa, dano, vida) { //+ niveles ganados? + posición?
					this.ataque = ataque
					this.defensa = defensa
					this.daño = daño
					this.vida = vida
				}
				
				switch (pjnum){
					case 1:
						tupj= new personaje(10,14,15,100);
						break;
					case 2:
						tupj= new personaje(5,16,5,150);
						break;
					case 3:
						tupj= new personaje(10,12,20,50);
				}		
					window.alert("Se creo con "+tupj.vida+" de vida");
				
				
				//crear enemigos / metodos del enemigo
				function enemigo(ataque, defensa, vida, dano, posx, poxy)
					this.ataque=ataque
					this.defensa=defensa
					this.vida=vida
					this.dano=dano
					
					this.posx=posx
					this.posy=posy
				}
				
				function ponerEnemigo(raza, posicionx, posiciony){
				}
				/*
				Goblin
				Ataque: 5
				Defensa: 10
				Vida: 10
				Daño: 5
				Orco
				Ataque: 10
				Defensa: 12
				Vida: 20
				Daño: 10
				*/
				
				//crear monedas
				//crear llave / condicional (si pj coge, aparece puerta)
				//crear puerta / condicional (si pj coge, pasa de nivel)
				
				//poner turnos / mover
				//acciones: caminar, atacar, defenderse, recoger
					//function caminar(personaje, posición){
					//}
				
				
				//crear batalla
				
				//cambiar nivel
});