var dicex=25;
var dicey=25;
var dicewidth=100;
var diceheight=100;
var dotrad=6;
var ctx;
var dx=100;
var dy=100;

function throwdice(){
	var sum;
	var ch=1+Math.floor(Math.random()*6);
	sum=ch;
	dx=dicex;
	dy=dicey;
	drawface(ch);
	dx=(dicex+150);
	ch=1+Math.floor(Math.random()*6);
	sum += ch;
	drawface(ch);

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
	}