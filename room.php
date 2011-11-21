<html>
<head>
	<link rel="stylesheet" href="css.css" type="text/css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	<?php
		$pj = $_POST["pj"];
	?>
	
	<script>
	//personaje, enemigo, paredes
	var y = 600;
	var x = 0;
	var x_pared = [0,    0,100,100,100,200,200,300,300,300,300,300,300,300,400,500,500,500,700,600,600,600];
	var y_pared = [100,500,300,500,600,100,300,0,  100,200,300,400,500,600,400,100,300,600,  0,200,400,700];
	var x_ene = [400, 0, 700];
	var y_ene = [700, 200, 400];
	var check = 0;
	var foco = 0;
	var contador = 0;
	
	//dados
	var dicex=25;
	var dicey=25;
	var dicewidth=100;
	var diceheight=100;
	var dotrad=6;
	var ctx;
	var dx=100;
	var dy=100;
	var sum; //important!!
	
	//personaje + atributos
	var pjnum = <?php echo "$pj";?>;
	
	
	function randomPosicionEnemigo(){
		for(i=0;i<3;i++){ 
			x_ene[i] = Math.floor(Math.random()*8)*100;
			y_ene[i] = Math.floor(Math.random()*8)*100;
		}
	}
	
	function cambiarPosicionEne(){
		randomPosicionEnemigo();
		for(r=0;r<3;r++){
			for(i=0;i<22;i++){		
				if(x_ene[r]==x_pared[i] && y_ene[r]==y_pared[i]){
					x_ene[r] = 400;
					y_ene[r] = 700;
				}
			}
		}
		$("#e0").css({"top": y_ene[0] + "px"});
		$("#e0").css({"left": x_ene[0] + "px"});

		$("#e1").css({"top": y_ene[1] + "px"});
		$("#e1").css({"left": x_ene[1] + "px"});	
		
		$("#e2").css({"top": y_ene[2] + "px"});
		$("#e2").css({"left": x_ene[2] + "px"});	
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
		contador = 0;
		for(i=0; i<3; i++ ){
			if(x==x_ene[i] && y==y_ene[i]){
				contador=contador+1;	
	
				$("#main").hide();
				$("#fight").toggleClass("active").next().slideToggle("slow");
				$("#fight").css({"visibility": "visible"});
				alert(contador);
	
				if(contador==2){
					$("#gob").css({"background": "url('images/gob2.png')"});
				}
				if(contador==3){
					$("#gob").css({"background": "url('images/gob3.png')"});
				}
			}
		} 
	}
	
	function throwdice(){
		var ch=1+Math.floor(Math.random()*6);
		sum=ch;
		dx=dicex;
		dy=dicey;
		drawface(ch);
		dx=(dicex+150);
		ch=1+Math.floor(Math.random()*6);
		sum += ch;
		drawface(ch);
		return sum;
	}
		
	function draw1(){
		var dotx;
		var doty;
		ctx.beginPath();
		dotx=dx+.5*dicewidth;
		doty=dy+.5*diceheight;
		ctx.arc(dotx,doty,dotrad,0,Math.PI*2,true);
		ctx.closePath();
		ctx.fill();
	}

	function draw2(){
		var dotx;
		var doty;
		ctx.beginPath();
		dotx=dx+3*dotrad;
		doty=dy+3*dotrad;
		ctx.arc(dotx,doty,dotrad,0,Math.PI*2,true);
		dotx=dx+dicewidth-3*dotrad;
		doty=dy+diceheight-3*dotrad;
		ctx.arc(dotx,doty,dotrad,0,Math.PI*2,true);
		ctx.closePath();
		ctx.fill();
	}
	
	function draw4(){
		var dotx;
		var doty;
		ctx.beginPath();
		dotx=dx+3*dotrad;
		doty=dy+3*dotrad;
		ctx.arc(dotx,doty,dotrad,0,Math.PI*2,true);
		dotx=dx+dicewidth-3*dotrad;
		doty=dy+diceheight-3*dotrad;
		ctx.arc(dotx,doty,dotrad,0,Math.PI*2,true);
		ctx.closePath();
		ctx.fill();
		ctx.beginPath();
	
		dotx=dx+3*dotrad;
		doty=dy+diceheight-3*dotrad;
		ctx.arc(dotx,doty,dotrad,0,Math.PI*2,true);
		dotx=dx+dicewidth-3*dotrad;
		doty=dy+3*dotrad;
		ctx.arc(dotx,doty,dotrad,0,Math.PI*2,true);
		ctx.closePath();
		ctx.fill();
	}
	
	function draw2mid(){
		var dotx;
		var doty;
		ctx.beginPath();
		dotx=dx+3*dotrad;
		doty=dy+.5*diceheight;
		ctx.arc(dotx,doty,dotrad,0,Math.PI*2,true);
		dotx=dx+dicewidth-3*dotrad;
		doty=dy+.5*diceheight;
		ctx.arc(dotx,doty,dotrad,0,Math.PI*2,true);
		ctx.closePath();
		ctx.fill();
	}
	
	function drawface(n){
		ctx=document.getElementById('canvas').getContext('2d');
		ctx.lineWidth=5;
		ctx.clearRect(dx,dy,dicewidth,diceheight);
		ctx.strokeRect(dx,dy,dicewidth,diceheight);
		var dotx;
		var doty;
		ctx.fillStyle="#009966";
			switch(n){
				case 1:
					draw1();
					break;
				case 2:
					draw2();
					break;
				case 3:
					draw2();
					draw1();
					break;
				case 4:
					draw4();
					break;
				case 5:
					draw4();
					draw1();
					break;
				case 6:
					draw4();
					draw2mid();
					break
			}
	}
	
	function pelea(){
		var sum =throwdice();
		if(contador==1){
			if(sum+tupj.ataque>enemigo.defensa){
				enemigo.vida=enemigo.vida-(sum+tupj.ataque);
				window.alert("IT'S FUCKING EFFECTIVE :D BITCH");
			}else{
				window.alert("U FAIL FRIEND D:");
			}
		}
		if(contador==2){
			if(sum+tupj.ataque>enemigo.defensa*2){
				enemigo.vida*2=enemigo.vida*2-sum+tupj.ataque;
				window.alert("IT'S FUCKING EFFECTIVE :D BITCH");
			}else{
				window.alert("U FAIL FRIEND D:");
			}
		}
		if(contador==3){
			if(sum+tupj.ataque>enemigo.defensa*3){
				enemigo.vida*3=enemigo.vida*3-sum+tupj.ataque;
				window.alert("IT'S FUCKING EFFECTIVE :D BITCH");
			}else{
				window.alert("U FAIL FRIEND D:");
			}
		}
		window.alert("Vida enemigo: "+enemigo.vida);
	}
	
	//conseguir atributos
	function personaje(ataque, defensa, dano, vida) { //+ niveles ganados? + posición?
		this.ataque = ataque;
		this.defensa = defensa;
		this.dano = dano;
		this.vida = vida;
	}
	
	//crear enemigos / metodos del enemigo
	function enemigo(ataque, defensa, vida, dano){
		this.ataque=ataque;
		this.defensa=defensa;
		this.vida=vida;
		this.dano=dano;
	}
	
	//////////////////////////
	////*/document.ready/*////
	$(document).ready(function(){
		$('#start').click(function(){
			foco = 1;
		});
		
		$("body").keypress(function(e) {
			if(foco==1){	
				if (e.which == 115) {
					//DOWN -S
					y = y +100;
					if(y > 700) y =700;
					detectarColision();
					if(check==1){
						y=y-100;
					}
					$("#a").css({"top": y + "px"});
					foco=0;
					cambiarPosicionEne();
					empezarBatalla();
				}
				if (e.which == 119) {
					//UP - W
					y = y - 100;
					if(y < 0 ) y = 0; 
					detectarColision();
					if(check==1){
						y=y+100;
					}
					$("#a").css({"top": y + "px"});
					foco=0;
					cambiarPosicionEne();
					empezarBatalla();  
				}
				if (e.which == 100) {
					//RIGHT - D
					x = x + 100;
					if(x > 700 ) x = 700;  
					detectarColision();
					if(check==1){
						x=x-100;
					}
					$("#a").css({"left": x + "px"});
					foco=0;
					cambiarPosicionEne();
					empezarBatalla();  
				}                                           
				if (e.which == 97) {
					//LEFT - A
					x = x - 100;
					if(x < 0) x = 0;
					detectarColision();
					if(check==1){
						x = x + 100;
					}
				$("#a").css({"left": x + "px"});
				foco=0;
				cambiarPosicionEne();
				empezarBatalla(); 
				}
			}
		});	
		
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
		
		enemigo = new enemigo(5,10,10,5);
	});

	/////////////////////////////////////
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

	</script>
</head>
<body>
<div id="main">
<div id="info">
	<div id="start">
		<p>START</p>
	</div>
</div>
<div id="cont">
	<div id="a">
		<img src="images/<?php echo $pj; ?>.png" alt="jugador" />
	</div>
	<div class="ene" id="e0">
	</div>
	<div class="ene" id="e1">
	</div>
	<div class="ene" id="e2">
	</div>
	<div id="llave">
	</div>
	<div id="door">
	</div>
</div>
<div id="room">
		<div id="b" class="pared">
		</div>
		<div id="c" class="pared">
		</div>
		<div id="d" class="pared">
		</div>
		<div id="e" class="pared">
		</div>
		<div id="f" class="pared">
		</div>
		<div id="g" class="pared">
		</div>
		<div id="h" class="pared">
		</div>
		<div id="i" class="pared">
		</div>
		<div id="j" class="pared">
		</div>
		<div id="k" class="pared">
		</div>
		<div id="l" class="pared">
		</div>
		<div id="m" class="pared">
		</div>
		<div id="n" class="pared">
		</div>
		<div id="o" class="pared">
		</div>
		<div id="p" class="pared">
		</div>
		<div id="q" class="pared">
		</div>
		<div id="r" class="pared">
		</div>
		<div id="s" class="pared">
		</div>
		<div id="t" class="pared">
		</div>
		<div id="u" class="pared">
		</div>
		<div id="v" class="pared">
		</div>
		<div id="w" class="pared">
		</div>
</div>
</div>
<div id="fight">
		<div id="batalla">
			<div id="pj">
				<img src="images/<?php echo $pj; ?>.png" alt="jugador" />
			</div>
			<div class="ene" id="gob">
			</div>
		</div>
		<div id="texto">
			<form action="" method="" name="f">
			<input type="text" id="TotoroPelea" name="TotoroPelea" />
			</form>
		</div>
		<div id="dados">
			<canvas id="canvas" width="350" height="200">
			No HTML5 for you
			</canvas>
			<div id="boton">
				<button onClick ="pelea();">Lanza los dados</button>
			</div>
		</div>
</div>
</body>
</html>