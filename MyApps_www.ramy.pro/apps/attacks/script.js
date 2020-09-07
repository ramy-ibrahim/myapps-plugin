// JavaScript Document

game = {
	
	section_name: 'my_game',
	left: 400,
	top:450,
	score:0,
	
	load:function(){
		var SetStyle =  document.createElement('link');
		SetStyle.rel = "stylesheet";
		SetStyle.type = "text/css";
		SetStyle.href = "style.css";
		
		
		var Plane1 = document.createElement('div');
		Plane1.id='plane1';
		Plane1.className = 'plane1';
		Plane1.style = 'left: 40%';
		Plane1.innerHTML = '<img src="images/plane1.png" />';
		
		
		
		
		var Shoot = document.createElement('div');
		Shoot.id = 'shoot';
		Shoot.style = 'display:none;';
		
		
		var Info = document.createElement('div');
		Info.id = 'info';
		Info.innerHTML = 'Score 0';
		
		var by = document.createElement('div');
		by.id = 'text_by';
		by.innerHTML = 'Developed By Ramy Ibrahim - www.gtmix.org';
		
		
		var start = document.createElement('input');
		start.type = 'button';
		start.value = 'Play';
		start.className = 'start_but';
		start.id = 'start_but';
		
		document.getElementById('my_game').appendChild(start);
		document.getElementById('my_game').appendChild(Info);
		document.getElementById('my_game').appendChild(by);
		document.getElementById('my_game').appendChild(SetStyle);
		document.getElementById('my_game').appendChild(Plane1);
		document.getElementById('my_game').appendChild(Shoot);
		
		
		
		
		
	},
	
	creat:function(){
	   	
		var left_pos = Math.floor(Math.random() * 850) + 1;
		var speed = Math.floor(Math.random() * 15) + 10;
		var id = 'attack_'+ Math.floor(Math.random() * 1000) + 100;;
		
		var GetInfo = document.getElementById('info');
		
		
		var attacker = document.createElement('div');
		
         attacker.id = id;     
		attacker.className = 'plane2 ';
		attacker.style = 'left: '+left_pos+'px; top:0px; animation-name:attack; animation-duration: '+speed+'s; ';
		attacker.innerHTML = '<img src="images/plane2.png" />';
		
		document.getElementById('my_game').appendChild(attacker);
		
		
		
		var getpos = setInterval(function(){
			
			var plane = document.getElementById(id);
			var get_shoot = document.getElementById('shoot');
			
			if(plane.offsetTop >= 390 ){
			      var myplane = document.getElementById('plane1');
				
				  plane.innerHTML = '<img src="images/boom.png" />';
				  myplane.innerHTML =  '<img src="images/boom.png" />';
				   
				  clearInterval(gameruning);
				
				setTimeout(function(){
					document.getElementById('my_game').removeChild(plane);
					document.getElementById('my_game').removeChild(myplane);
					
					document.getElementById('info').innerHTML += ' Game Over';
					clearInterval(getpos);
				},100);
		         
				
			}else if(get_shoot.offsetTop <= plane.offsetTop + 150 && get_shoot.offsetLeft >= plane.offsetLeft  && get_shoot.offsetLeft <= plane.offsetLeft + 150 ){
					 
				plane.innerHTML = '<img src="images/boom.png" />';
				
				 game.score++;
				GetInfo.innerHTML = 'Score '+ game.score;
				
				setTimeout(function(){
					document.getElementById('my_game').removeChild(plane);
					clearInterval(getpos);
				},100);
				
				
					 }
			
			
			
			
			
		},500);
	},
	
	move:function(dir){
		var plane1 = document.getElementById('plane1');
	   
		
		  if(dir == 'left' && plane1.offsetLeft >= 1){
		      
		      plane1.style = 'left:'+(plane1.offsetLeft - 20)+'px';
		  
		   }else if(dir == 'right' && plane1.offsetLeft <= 880){
			   
		        plane1.style = 'left:'+(plane1.offsetLeft + 20)+'px';
		   }
		
	},
	
	
	shoot:function(){
		 var shoot = document.getElementById('shoot');
         var shoot_left  = document.getElementById('plane1').offsetLeft + 50;
		 var shoot_pos;
		 
		
		 shoot.style = 'top:'+this.top+'px; left:'+shoot_left +'px';
		 shoot.style.display = 'block';
		
		var timer = setInterval(function(){
			shoot_pos =  shoot.offsetTop - 10;
		   
			
			if(shoot_pos >2){
				shoot.style = 'top:'+shoot_pos+'px; left:'+shoot_left+'px;';
				
				
			}else{
				shoot.style.display = 'none';
				clearInterval(timer);
			}
			
			
		},20);
		
	},
	
	
	
	
	attack:function(){
	    var count = Math.floor(Math.random() * 4) + 1;    
		
		for(L=1;L<=count;L++){
			this.creat();
		}
		
		
		
    },
	
	start:function(){
		
		document.getElementById('start_but').style.display = 'none';
		game.attack();
		
		gameruning = setInterval(function(){
		 
		game.attack();
		
     	},5000);
	}
	
}




window.onload = function(){
	game.load();
	
  document.getElementById('start_but').onclick = function(){game.start()}	
}

document.body.onkeydown = function(num){
	
	
	if(num.keyCode == 39){
		game.move('right');
		
		
		
	}else if(num.keyCode == 37){
		game.move('left');
		
			 
    }
	
	if(num.keyCode == 32){
	    game.shoot();
		
	}
}