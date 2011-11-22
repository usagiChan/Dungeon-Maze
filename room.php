sa<html>
<head>
	<link rel="stylesheet" href="css.css" type="text/css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	<?php
		$pj = $_POST["pj"];
	?>
	
	<script>
	//room1
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
	var existenciaEnemiga =3;
	
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
	var tngolapchellve =0;
	
	var puertalocX = 400;
	var puertalocY = 300;
	var lvl=0;
	var prsonaje= "#a";
	var llveX = 0;
	var llveY =0;
	var enemigoV= "#e";
	var llveid = "#llave";
	var puerta = "#door";
	var enemxLvl = "#gob";
	var cant=0;
	
	
	//personaje + atributos
	var pjnum = <?php echo "$pj";?>;
	
	
	function randomPosicionEnemigo(){
		for(i=0;i<(existenciaEnemiga);i++) { 
			x_ene[i] = Math.floor(Math.random()*8)*100;
			y_ene[i] = Math.floor(Math.random()*8)*100;
		}
	}
	function encontrarLLave(){
		if(x==llveX && y==llveY){
			$(llveid).hide();
			$(puerta).css({"visibility": "visible"});
			existenciaEnemiga=0;
			tngolapchellve=1;
			for(i=0;i<3;i++){
						x_ene[existenciaEnemiga+i] = 1000;
						y_ene[existenciaEnemiga+i] = 1000;
						var chr = enemigoV+i;
						$(chr).hide();
			}
			window.alert("HOLY SHIT DUDE, THE POWA OF DA KEY KABOOOOOMED THINE ENEMIES L33T!!!");
		}	
	}
	
	function encontrarPuerta(){
		if(existenciaEnemiga==0 && tngolapchellve==1){
			if(x==puertalocX && y==puertalocY){
				if(lvl==0){
					$("#main").toggleClass("active").slideToggle("slow");
					$("#fight").css({"visibility": "hidden"});
					$("#fight").css({"display": "none"});
					$("#main2").show();
					$("#main2").css({"visibility": "visible"});
					$("#main").hide();
					
					 y = 0;
					 x = 700;
					 x_pared = [300,400,100,600,700,200,300,400,  0,300,500,600,0,600,400,  0,100,200,400,200,400,600];
					 y_pared = [0,  0,  100,100,100,200,200,200,300,300,300,300,0,400,700,500,500,500,500,600,600,600];
					 x_ene = [400, 0, 700];
					 y_ene = [700, 200, 400];
					 check = 0;
					 foco = 0;
					 contador = 0;
					 existenciaEnemiga =3;
					 puertalocX = 0;
					 puertalocY = 400;
					 lvl=1;
					 prsonaje = "#a2";
					 llveX = 0;
					 llveY = 600;
					 enemigoV = "#en";
					 enemxLvl = "#orc";
					 
					 puerta = "#door2";
					 llveid = "#llave2";
					 enemigo.ataque = 10;
					 enemigo.defensa = 12;
					 enemigo.vida = 20;
					 enemigo.dano = 10;
					 
					 
					 
				}	
				else {
					location.href = "won.html";
				}
			}
		}
	}
	
	function cambiarPosicionEne(){
		randomPosicionEnemigo();
		for(r=0;r<3;r++){
			for(i=0;i<22;i++){		
				if(x_ene[r]==x_pared[i] && y_ene[r]==y_pared[i]){
					x_ene[r] = 600;
					y_ene[r] = 500;
				}
			}
		}
		$(enemigoV+0).css({"top": y_ene[0] + "px"});
		$(enemigoV+0).css({"left": x_ene[0] + "px"});

		$(enemigoV+1).css({"top": y_ene[1] + "px"});
		$(enemigoV+1).css({"left": x_ene[1] + "px"});	
		
		$(enemigoV+2).css({"top": y_ene[2] + "px"});
		$(enemigoV+2).css({"left": x_ene[2] + "px"});	
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
	
				if(lvl==0){
					$("#main").hide();}
				else{$("#main2").hide();}
				$("#fight").show();
				$("#fight").css({"visibility": "visible"});
				alert(contador);
	
				if(lvl==0){
					if(contador==2){
						$("#gob").css({"background": "url('images/gob2.png')"});
						cant=2;
					}
					if(contador==3){
						$("#gob").css({"background": "url('images/gob3.png')"});
						cant=3;
					}
				}
				else {
					if(contador==1){$("#gob").css({"background": "url('images/orc.png')"});}
					if(contador==2){
						$("#gob").css({"background": "url('images/orc2.png')"});
						cant=2;
					}
					if(contador==3){
						$("#gob").css({"background": "url('images/orc3.png')"});
						cant=3;
					}
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
			if(enemigo.defensa>0){
					enemigo.defensa=enemigo.defensa-(sum+tupj.ataque);
					window.alert("You lowered his frakking defense " + enemigo.defensa);
				}else{
					enemigo.vida=enemigo.vida-(sum+tupj.ataque);
					window.alert("zomg holy shit u pwn " + enemigo.vida);
				}
			if(enemigo.vida > 0){
				sum= throwdice();
				if(tupj.defensa>0){
					tupj.defensa = tupj.defensa-(sum+enemigo.ataque);
					window.alert("t quedan de defensa " +tupj.defensa);
				}else{
					tupj.vida = tupj.vida-(sum+enemigo.ataque);
					window.alert("te sacan la mrddddddd "+tupj.vida);
				}
			}else{
				window.alert("has obliterado a tu enemigo!!!");
				$("#fight").css({"visibility": "hidden"});
				$("#fight").css({"display": "none"});				
				if(lvl==0){
					$("#main").show();}
				else{$("#main2").show();}
				existenciaEnemiga=existenciaEnemiga-1;				
				x_ene[existenciaEnemiga] = 1000;
				y_ene[existenciaEnemiga] = 1000;
				if(lvl==0){
					enemigo.defensa=10;
					enemigo.vida=10;
					enemigo.ataque=5;
					}
				if(lvl==1){
					enemigo.defensa=12;
					enemigo.vida=20;
					enemigo.ataque=10;
						}
				var chr = enemigoV+existenciaEnemiga;
				$(chr).hide();
				}
			if(tupj.vida<1){
					window.alert("perdiste tarado");
					location.href = "failed.html";
				}
		}
		if(contador==2){
				if(cant==2){
				enemigo.defensa=enemigo.defensa*2;
				enemigo.vida=enemigo.vida*2;
				enemigo.ataque= enemigo.ataque*2;
				cant=-1;
				}
				
			if(enemigo.defensa>0){
					enemigo.defensa=enemigo.defensa-(sum+tupj.ataque);
					window.alert("You lowered his frakking defense " + enemigo.defensa);
				}else{
					enemigo.vida=enemigo.vida-(sum+tupj.ataque);
					window.alert("zomg holy shit u pwn " + enemigo.vida);
				}
			if(enemigo.vida > 0){
				sum= throwdice();
				if(tupj.defensa>0){
					tupj.defensa = tupj.defensa-(sum+enemigo.ataque);
					window.alert("t quedan de defensa " +tupj.defensa);
				}else{
					tupj.vida = tupj.vida-(sum+enemigo.ataque);
					window.alert("te sacan la mrddddddd "+tupj.vida);
				}
			}else{
				window.alert("has obliterado a tu enemigo!!!");
				if(lvl==0){
					$("#main").show();}
				else{$("#main2").show();}
				$("#fight").css({"visibility": "hidden"});
				$("#fight").css({"display": "none"});
				existenciaEnemiga=existenciaEnemiga-2;	
				if(existenciaEnemiga>0){
					for(i=0;i<2;i++){
						x_ene[existenciaEnemiga+i] = 1000;
						y_ene[existenciaEnemiga+i] = 1000;
						var chr = enemigoV+existenciaEnemiga+i;
						$(chr).hide();
					}}
				if(lvl==0){
					enemigo.defensa=10;
					enemigo.vida=10;
					enemigo.ataque=5;
					}
				if(lvl==1){
					enemigo.defensa=12;
					enemigo.vida=20;
					enemigo.ataque=10;
						}
				
				}
			if(tupj.vida<1){
					window.alert("perdiste tarado");
					location.href = "failed.html";
				}
		}
		if(contador==3){
			if(cant==3){
				enemigo.defensa=enemigo.defensa*3;
				enemigo.vida=enemigo.vida*3;
				enemigo.ataque= enemigo.ataque*3;
				cant=-1;
				}
				
			if(enemigo.defensa>0){
					enemigo.defensa=enemigo.defensa-(sum+tupj.ataque);
					window.alert("You lowered his frakking defense " + enemigo.defensa);
				}else{
					enemigo.vida=enemigo.vida-(sum+tupj.ataque);
					window.alert("zomg holy shit u pwn " + enemigo.vida);
				}
			if(enemigo.vida > 0){
				sum= throwdice();
				if(tupj.defensa>0){
					tupj.defensa = tupj.defensa-(sum+enemigo.ataque);
					window.alert("t quedan de defensa " +tupj.defensa);
				}else{
					tupj.vida = tupj.vida-(sum+enemigo.ataque);
					window.alert("te sacan la mrddddddd "+tupj.vida);
				}
			}else{
				window.alert("has obliterado a tu enemigo!!!");
				if(lvl==0){
					$("#main").show();}
				else{$("#main2").show();}
				$("#fight").css({"visibility": "hidden"});
				$("#fight").css({"display": "none"});
				existenciaEnemiga=existenciaEnemiga-3;	
				if(existenciaEnemiga>0){
					for(i=0;i<3;i++){
						x_ene[existenciaEnemiga+i] = 1000;
						y_ene[existenciaEnemiga+i] = 1000;
						var chr = enemigoV+existenciaEnemiga+i;
						$(chr).hide();
					}
					}
				
				if(lvl==0){
					enemigo.defensa=10;
					enemigo.vida=10;
					enemigo.ataque=5;
					}
				if(lvl==1){
					enemigo.defensa=12;
					enemigo.vida=20;
					enemigo.ataque=10;
						}
				
				}
			if(tupj.vida<1){
					window.alert("perdiste tarado");
					location.href = "failed.html";
				}
		}

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
		$("#start").click(function(){
			foco = 1;
		});
		
		$("#start2").click(function(){
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
					$(prsonaje).css({"top": y + "px"});
					foco=0;
					cambiarPosicionEne();
					empezarBatalla();
					encontrarLLave();
					encontrarPuerta();
				}
				if (e.which == 119) {
					//UP - W
					y = y - 100;
					if(y < 0 ) y = 0; 
					detectarColision();
					if(check==1){
						y=y+100;
					}
					$(prsonaje).css({"top": y + "px"});
					foco=0;
					cambiarPosicionEne();
					empezarBatalla();  
					encontrarLLave();
					encontrarPuerta();
				}
				if (e.which == 100) {
					//RIGHT - D
					x = x + 100;
					if(x > 700 ) x = 700;  
					detectarColision();
					if(check==1){
						x=x-100;
					}
					$(prsonaje).css({"left": x + "px"});
					foco=0;
					cambiarPosicionEne();
					empezarBatalla();
					encontrarLLave();
					encontrarPuerta();
				}                                           
				if (e.which == 97) {
					//LEFT - A
					x = x - 100;
					if(x < 0) x = 0;
					detectarColision();
					if(check==1){
						x = x + 100;
					}
					$(prsonaje).css({"left": x + "px"});
				foco=0;
				cambiarPosicionEne();
				empezarBatalla(); 
				encontrarLLave();
				encontrarPuerta();
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
<div id="main2">
<div id="info2">
	<div id="start2">
		<p>START</p>
	</div>
</div>
<div id="cont2">
	<div id="a2">
		<img src="images/<?php echo $pj; ?>.png" alt="jugador" />
	</div>
	<div class="ene" id="en0">
	</div>
	<div class="ene" id="en1">
	</div>
	<div class="ene" id="en2">
	</div>
	<div id="llave2">
	</div>
	<div id="door2">
	</div>
</div>
<div id="room2">
		<div id="b2" class="pared">
		</div>
		<div id="c2" class="pared">
		</div>
		<div id="d2" class="pared">
		</div>
		<div id="e2e" class="pared">
		</div>
		<div id="f2" class="pared">
		</div>
		<div id="g2" class="pared">
		</div>
		<div id="h2" class="pared">
		</div>
		<div id="i2" class="pared">
		</div>
		<div id="j2" class="pared">
		</div>
		<div id="k2" class="pared">
		</div>
		<div id="l2" class="pared">
		</div>
		<div id="m2" class="pared">
		</div>
		<div id="n2" class="pared">
		</div>
		<div id="o2" class="pared">
		</div>
		<div id="p2" class="pared">
		</div>
		<div id="q2" class="pared">
		</div>
		<div id="r2" class="pared">
		</div>
		<div id="s2" class="pared">
		</div>
		<div id="t2" class="pared">
		</div>
		<div id="u2" class="pared">
		</div>
		<div id="v2" class="pared">
		</div>
		<div id="w2" class="pared">
		</div>
</div>
</div>
</body>
</html>