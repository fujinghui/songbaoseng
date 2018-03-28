
			var canvas;
			var context;
			var CW=400, CH=300;
			var curTime = new Date();
			var time = 3600;
			var balls = [];
			
			var hh, hl, mh, ml, sh, sl;	//时，分，秒
			var ohh, ohl, omh, oml, osh, osl;	//老的时，分，秒
			
			window.onload = function(){
				canvas = document.getElementById("clock_canvas");
				canvas.width = CW;
				canvas.hasMedia = CH;
				context = canvas.getContext("2d");
				time = curTime.getHours() * 3600 + curTime.getMinutes() * 60 + curTime.getSeconds();
				
				
				hh = parseInt(time / 3600 / 10); hl = parseInt(time / 3600 % 10);
				mh = parseInt(time % 3600 / 60 / 10); ml = parseInt(time % 3600 / 60 % 10);
				sh = parseInt(time % 3600 % 60 / 10); sl = parseInt(time % 3600 % 60 % 10);
				ohh = hh; ohl = hl; omh = mh; oml = ml; osh = sh; osl = sl;
				
				drawClock(context, 10, 10, 300, time);
				setInterval(render, 50);
				//setInterval(drawBalls, 33);
			}
			
			//绘制一堆小球
			function drawBalls(){
				//context.fillText(balls.length + " ", 10, 300);
				//context.globalCompositeOperation = "light";
				for(var i = 0; i < balls.length; i ++)
				{
					context.beginPath();
					context.fillStyle = balls[i].color;
					//var gradient = context.createRadialGradient(balls[i].x, balls[i].y, 0, balls[i].x, balls[i].y, balls[i].r);
					//gradient.addColorStop(0, "white");
					//gradient.addColorStop(0.2, "white");
					//gradient.addColorStop(0.4, balls[i].color);
					//gradient.addColorStop(1, "#444444");
					//context.fillStyle = gradient;
					
					context.arc(balls[i].x, balls[i].y, balls[i].r, 0, Math.PI * 2, false);
					context.closePath();
					context.fill();
					balls[i].x += balls[i].vx;
					balls[i].y += balls[i].vy;
					balls[i].vy += balls[i].g;
					if(balls[i].y >= CH - balls[i].r * 2)
					{
						balls[i].vy = -balls[i].vy * 0.75;
						balls[i].y = CH - balls[i].r * 2;
					}
				}
				var cnt = 0;
				for(var i = 0; i < balls.length; i ++)
				{
					//小球跳出了画面
					if(balls[i].x + balls[i].r * 2 <= 0)
					{
						
					}
					else if(balls[i].x > CW)
					{
						
					}
					else		//该小球存在
					{
						balls[cnt] = balls[i];
						cnt ++;
					}
				}
				while(balls.length > cnt || balls.length > 300)
					balls.pop();
				
			}
			
			function addBalls(num, x, y, width){
				var r = Math.floor(width / 10);
				var color = femyColors[Math.round(Math.random() * 7)];
				for(var i = 0; i < 10; i ++)
				{
					for(var j = 0; j < 7; j ++)
					{
						if(digit[num][i][j] == 1)
						{
							balls.push({
								x:x + (j + 1) * r,
								y:y + (i + 1) * r,
								r:r / 2,
								vx:(Math.random() * 2 - 1)>0?4:(-4),
								vy:0,
								g:Math.random() * 2 + 1,
								color:femyColors[Math.round(Math.random() * 7)]
							});
							//break;
						}
					}
				}
				
			}
			
			function render(){
				//context.clearRect(0, 0, CW, CH);
				context.globalCompositeOperation = "source-over";
				context.fillStyle = "rgba(255, 255, 210, 0.4)";
				context.fillRect(0, 0, CW, CH);
				context.fillStyle = "#f295a3";
				
				curTime = new Date();
				time = curTime.getHours() * 3600 + curTime.getMinutes() * 60 + curTime.getSeconds();

				
				drawClock(context, 10, 10, 400, time);
				drawBalls();
				time ++;
			}
			
			function drawClock(ctx, x, y, width, time){
				var w = width / 7;
				
				hh = parseInt(time / 3600 / 10); hl = parseInt(time / 3600 % 10);
				mh = parseInt(time % 3600 / 60 / 10); ml = parseInt(time % 3600 / 60 % 10);
				sh = parseInt(time % 3600 % 60 / 10); sl = parseInt(time % 3600 % 60 % 10);
				
				
				if(ohh != hh)
					addBalls(hh, x, y, w);
				if(ohl != hl)
					addBalls(hl, x + w, y, w);
				if(omh != mh)
					addBalls(mh, x + w * 2.5, y, w);
				if(oml != ml)
					addBalls(ml, x + w * 3.5, y, w);
				if(osh != sh)
					addBalls(sh, x + w * 5, y, w);
				if(osl != sl)
					addBalls(sl, x + w * 6, y, w);
				
				//drawDigit(ctx, 0, x, y, w, 100);
				
				drawDigit(ctx, parseInt(hh), x, y, w, 100);
				drawDigit(ctx, parseInt(hl), x + w, y, w, 100);
				drawDigit(ctx, 10, x + w * 2, y, w / 2, 100);
				drawDigit(ctx, parseInt(mh), x + w * 2.5, y, w, 100);
				drawDigit(ctx, parseInt(ml), x + w * 3.5, y, w, 100);
				drawDigit(ctx, 10, x + w * 4.5, y, w / 2, 100);
				drawDigit(ctx, parseInt(sh), x + w * 5, y, w, 100);
				drawDigit(ctx, parseInt(sl), x + w * 6, y, w, 100);
				
				//drawDigit(ctx, 12, x + 10, y + 100, w * 2, 100);
				ohh = hh; ohl = hl; omh = mh; oml = ml; osh = sh; osl = sl;
			}
			function drawDigit(ctx, num, x, y, width, height){
				var r = (width) / 10;//(((width-20) / 10) <= ((height-14) / 7))?(width / 10):(height/7);
				//context.fillStyle = "#ff0000";
				for(var i = 0; i < 10; i ++)
				{
					for(var j = 0; j < 10; j ++)
					{
						if(digit[num][i][j] == 1)
						{
							ctx.beginPath();
							ctx.arc(x + j * (r + 1), y + i * (r + 1), r / 2, 0, Math.PI * 2);
							ctx.closePath();
							ctx.fill();
						}
					}
				}
			}
			