var FRes = new Object();

FRes.String = {
	lead_name:"侦探",
	butcher:"屠夫",
	staff:"工作人员",
	ephor:"长官",
	laohan:"老汉",
	caution:"警示",
	help:"上下左右控制主角行走，在最后一个关卡‘A’键能够发射子弹，当走到传送点时，按下空格可进行传送！",
	
	scoring1:"已抓捕的盗猎分子：",
	scoring2:"已解救的动物数量：",
	plot_hint1:"最近，中国珍稀动物保护联盟得到了一个紧急情报：有一批不法分子在青藏地区盗猎了一大批珍稀动物。他们准备在一个月内将这批珍稀动物转移到国外并售卖。但是，除了这则消息，中国珍稀动物保护联盟没有其他的情报。侦探在接受到任务之后需要先了解一下青藏地区的珍稀动物类型，以及盗猎份子去盗猎可能需要的物品，这些对寻找盗猎份子的行踪很有帮助！",
	plot_hint2:"根据线索，侦探发现有一些牦牛肉，而且卖的贵于其他摊位的家养牦牛肉，根据小贩小声透露，这些都是野牦牛，味道和口感比家养的牦牛好多了，侦探继而探出他们的收购野牦牛的上家也是一群不法份子。从小贩那里得知他们的车牌号码是藏Exxxx。侦探之后通过公安机关的帮助调取数据在十天前，这辆车在进入安多县的高速公路收费站经过了。然后侦探火速前往收费站调取监控录像，发现确实是那辆车，而且车上有很多汽油以及各种野外生存物资。此时扎西更接近盗猎分子了。侦探出来之后在公路旁看到有辆皮卡车正好要通过高速公路收费站，车后面有几个箱子，箱子上面有一丝血迹还有一些毛。这引起了侦探的怀疑，正要上前询问查看一下，那辆车方法察觉到了他，急速地向前开走，事出无偿必有妖，侦探赶快开车追去。 ",
	plot_hint3:"最后，线索会指引玩家去当地最大的药店。（因为青藏地区气候严寒，海拔高，氧气稀薄，人们在那里剧烈运动时候会呼吸困难，容易患肺水肿之类的病，所以进入无人区捕猎的犯罪分子一定需要大量准备专用的药物的。）在药店，询问近期有没有人来药店购买大量的治疗肺水肿的药物的人，或者行为穿着怪异的人出没，店员印象中有一个风尘仆仆的人购买了大量的治疗肺水肿的药物。侦探通过调取监控录像发现了嫌疑人，嫌疑人在药店门外有一个小皮卡汽车，店员在帮他将药品箱子搬运到车上的时候，发现车后面有六桶汽油，还有丝丝血迹，和零零散散的羊毛。药店老板也提供了关于嫌疑人的消息，说其每年的5月份他大概都会来这里购买大量的治疗肺水肿的药品。侦探也发现，嫌疑人的出行习惯和藏羚羊的迁徙捕猎时期恰好想吻合。（　藏羚羊主要栖息在西藏羌塘、新疆阿尔金山以及青海三江源和可可西里保护区内。藏羚羊每年12月交配，翌年6月底至7月上旬产仔，妊娠期200天左右。每年进入5月，都会有来自上述保护区内的数万只藏羚羊前往号称“大产房”的卓乃湖产仔，8月母藏羚羊带着年幼的小藏羚羊回迁，各自返回栖息地。）至此嫌疑人的行为越来越符合盗猎分子的习性。根据药店老板提供的车牌号，由公安系统发现他们已经出发前往可可西里。",
	plot_hint4:"打败敌人之后，得到线索，被关押的一群珍稀保护动物被关押在羌塘无人区的一个迷宫地区，有很多人看守。",
	plot_hintall:""+
"<span style='color:#f00'>第一关之前的情节：</span><br />"+
	"最近，中国珍稀动物保护联盟得到了一个紧急情报：有一批不法分子在青藏地区盗猎了一大批珍稀动物。他们准备在一个月内将这批珍稀动物转移到国外并售卖。但是，除了这则消息，中国珍稀动物保护联盟没有其他的情报。侦探在接受到任务之后需要先了解一下青藏地区的珍稀动物类型，以及盗猎份子去盗猎可能需要的物品，这些对寻找盗猎份子的行踪很有帮助！"+
"<br /><span style='color:#f00;'>第二关之前的情节：</span><br />"+
	"根据线索，侦探发现有一些牦牛肉，而且卖的贵于其他摊位的家养牦牛肉，根据小贩小声透露，这些都是野牦牛，味道和口感比家养的牦牛好多了，侦探继而探出他们的收购野牦牛的上家也是一群不法份子。从小贩那里得知他们的车牌号码是藏Exxxx。侦探之后通过公安机关的帮助调取数据在十天前，这辆车在进入安多县的高速公路收费站经过了。然后侦探火速前往收费站调取监控录像，发现确实是那辆车，而且车上有很多汽油以及各种野外生存物资。此时扎西更接近盗猎分子了。侦探出来之后在公路旁看到有辆皮卡车正好要通过高速公路收费站，车后面有几个箱子，箱子上面有一丝血迹还有一些毛。这引起了侦探的怀疑，正要上前询问查看一下，那辆车方法察觉到了他，急速地向前开走，事出无偿必有妖，侦探赶快开车追去。"+ 
"<br /><span style='color:#f00;'>第三关之前的情节：</span><br />"+
	"最后，线索会指引玩家去当地最大的药店。（因为青藏地区气候严寒，海拔高，氧气稀薄，人们在那里剧烈运动时候会呼吸困难，容易患肺水肿之类的病，所以进入无人区捕猎的犯罪分子一定需要大量准备专用的药物的。）在药店，询问近期有没有人来药店购买大量的治疗肺水肿的药物的人，或者行为穿着怪异的人出没，店员印象中有一个风尘仆仆的人购买了大量的治疗肺水肿的药物。侦探通过调取监控录像发现了嫌疑人，嫌疑人在药店门外有一个小皮卡汽车，店员在帮他将药品箱子搬运到车上的时候，发现车后面有六桶汽油，还有丝丝血迹，和零零散散的羊毛。药店老板也提供了关于嫌疑人的消息，说其每年的5月份他大概都会来这里购买大量的治疗肺水肿的药品。侦探也发现，嫌疑人的出行习惯和藏羚羊的迁徙捕猎时期恰好想吻合。（　藏羚羊主要栖息在西藏羌塘、新疆阿尔金山以及青海三江源和可可西里保护区内。藏羚羊每年12月交配，翌年6月底至7月上旬产仔，妊娠期200天左右。每年进入5月，都会有来自上述保护区内的数万只藏羚羊前往号称“大产房”的卓乃湖产仔，8月母藏羚羊带着年幼的小藏羚羊回迁，各自返回栖息地。）至此嫌疑人的行为越来越符合盗猎分子的习性。根据药店老板提供的车牌号，由公安系统发现他们已经出发前往可可西里。"+
"<br /><span style='color:#f00;'>第四关之前的情节：</span><br />"+
	"打败敌人之后，得到线索，被关押的一群珍稀保护动物被关押在羌塘无人区的一个迷宫地区，有很多人看守。",
	dialog_system:{
		dialog_1:[
		{name:"系统", context:"到处走走吧，看看有没有什么线索！（提示：可以和一些npc对话得到线索）"}
		]
	},
	dialog2:{
		dialog_1:
		[
		{name:"长官", context:"这次有一个任务需要你去完成！去青藏地区解救一批被盗猎分子囚禁的动物。但是在此之前，我们需要对你进行一次测验，看你是否有能力完成此项任务！"},
		{name:"侦探", context:"好的!"}
		],
		dialog_2:
		[
		{name:"长官", context:"还要再次进行检测吗？",select:true},
		{name:"侦探", context:"是的！"},
		],
		dialog_3:
		[
		{name:"长官", context:"恭喜你完成了我们的测验，你可以去完成本次的任务了！"},
		{name:"侦探", context:"是的，长官！"}
		],
		dialog_4:
		[
		{name:"长官", context:"很抱歉你没有完成此次测验，我们还不能将这个任务交给您！"}
		],
		dialog_5:
		[
		{name:"长官", context:"交给你的任务完成了吗？"}
		],
		dialog_6:
		[
		{name:"老乡", context:"今天买的野耗牛肉真新鲜啊！好吃好吃！"},
		{name:"侦探", context:"老乡，请问您买的野耗牛肉是在哪里买的呢？"},
		{name:"老乡", context:"哦，是在前面的肉贩市场"},
		{name:"侦探", context:"那谢谢了，老乡！"}
		],
		dialog_7:
		[
		{name:"老乡", context:"你买到耗牛肉了吗？"}
		],
		dialog_8:
		[
		{name:"小贩", context:"卖耗牛肉勒，快来看看吧，新鲜的耗牛肉勒！"},
		{name:"侦探", context:"老板，有没有野耗牛肉呀！"},
		{name:"小贩", context:"有的，请问您要多少？"},
		{name:"侦探", context:"老板，我想要很多呢，能不能冒昧的问一下，您的货源有什么渠道吗？"},
		{name:"小贩", context:"货源不清楚哎，只知道送货的 车牌号前面是“藏E”。"},
		{name:"侦探", context:"（藏E?好像是北边的安多县的车牌号。）那谢谢老板啦！"}
		],
		dialog_9:
		[
		{name:"小贩", context:"你找到他们了吗？"}
		],
		dialog_10:
		[
		{name:"侦探", context:"？？？！那里有一辆可疑的车辆，让我们跟上去看看吧！"}
		],
		dialog_11:
		[
		{name:"侦探", context:"经过审问得知，司机是盗猎分子的同伙，其同伴几天前前往安多县购买治疗肺水肿的药品了！"}
		],
		dialog_12:
		[
		{name:"系统", context:"盗猎分子经常活动于高原地区，他们可能需要一些药物(如治疗肺水肿的药物)，不如去药店查看查看线索吧！"}
		],
		dialog_13:
		[
		{name:"老板", context:"这位顾客，请问您想要点什么？"},
		{name:"侦探", context:"老板，我想问问最近有没有人大量购买治疗肺水肿的药品呢？"},
		{name:"老板", context:"这个，，，好像是有这么一些人"},
		{name:"侦探", context:"那你知道他们去哪了吗？"},
		{name:"老板", context:"听他们的谈话，好像是去了可可西里！"},
		{name:"侦探", context:"那好的，多谢老板！"}
		],
		dialog_14:
		[
		{name:"老板", context:"请问你需要什么？"}
		],
		dialog_15:
		[
		{name:"侦探", context:"那边有一些可疑的人，去瞧一瞧他们在干什么！"}
		],
		dialog_16:
		[
		{name:"嫌疑人1", context:"你们都给我听好了，这次我们抓到的动物都给看好了，别出了什么差错！"},
		{name:"嫌疑人2", context:"是。我们都会小心的！"},
		{name:"侦探", context:"(原来这些动物就是他们盗走的。不行，不能让他们带走，我要制止他们)"},
		{name:"侦探", context:"你们给我站住，我是警察，不要动"},
		{name:"嫌疑人", context:"可恶，是警察，快跑！"}
		],
		dialog_17:
		[
		{name:"侦探", context:"说，你们把动物都给藏到哪了？"},
		{name:"嫌疑人", context:"这,,,,它们被关在南边的灌木从中！"},
		{name:"侦探", context:"行。不过你们最好别耍花样。"},
		{name:"系统", context:"快去解救这些动物吧，它们就在南边的那条路上！"}
		],
		dialog_18:
		[
		{name:"系统", context:"还有动物未解救"}
		],
		dialog_19:
		[
		{name:"系统", context:"还有敌人未杀死"}
		],
		dialog_20:
		[
		{name:"系统", context:"请先完成前面的关卡!"}
		],
		dialog_21:
		[
		{name:"系统", context:"请前往中国珍稀动物保护联盟接受任务。"}
		],
		dialog_end:
		[
		{name:"ff", context:"-----------"},
		{name:"系统", context:"恭喜您成功的解救了所有动物！"}
		],
		
		
	},
	
	dialog:{
		dialog_1:
		[
		{name:"长官", context:"侦探，这次给你的任务是解救一批珍稀动物"},
		{name:"侦探", context:"珍稀动物？"},
		{name:"侦探", context:"对，前两天我们收到消息：有一批不法分子在青藏地区盗猎了一大批珍稀动物。他们准备在以一个月内将这批珍稀动物转移到国外，并售卖。但是除此之外，我没有其它的情报。你需要自己找寻线索来解救珍稀动物。"},
		{name:"侦探", context:"那现在这群人应该在青藏地区吧？"},
		{name:"侦探", context:"我也不敢保证，不过从目前的情况来看，他们最有可能的位置就是西藏地区。"},
		{name:"侦探", context:"......"},
		{name:"侦探", context:"此次的任务非常艰难，而且危险性极高。"},
		{name:"侦探", context:"长官，动物本就是人类的朋友，没有他们，我们的家园就不完整，解救它们我义不容辞，而且我相信自己的能力。"},
		{name:"侦探", context:"辛苦你了。"}
		],
		dialog_2:
		[
		{name:"侦探", context:"今天买的牦牛肉吃着真是好吃，跟家养的牦牛肉吃着就是不一样。啧啧啧……"},		
		{name:"侦探", context:"心想：青藏地区的牦牛一般是分为两类，一类是家养的牦牛，一类是野生牦牛。野牦牛是国家一级保护动物。因为野生牦牛的肉质更加筋道，多以总有一些盗猎分子捕杀野牦牛食用或者售卖。那这位老汉是不是买到野牦牛肉了呢？上前问一问。"},
		{name:"侦探", context:"老乡，今个天气不错啊！"},
		{name:"侦探", context:"恩，是啊，你看起来不像我们这儿的人呢！"},
		{name:"侦探", context:"是啊，老乡，我是来这边旅游的，刚刚听您说什么很好吃的样子，我这外地来的游客想尝一尝你们这里的美食呢，老乡跟我说道说道呗。"},
		{name:"老汉", context:"哈哈，我们西藏不仅有一望无际的高原草地，还有很多好吃的美食，刚刚说的呀就是牦牛肉啊，这牦牛肉啊味道可是倍儿棒，尤其是野牦牛的肉啊特别筋道。"},
		{name:"侦探", context:"野牦牛？那不是国家一级保护动物嘛！怎么能吃啊？"},
		{name:"老汉", context:"野牦牛？那不是国家一级保护动物嘛！怎么能吃啊？老汉：是啊，野牦牛一般是不能吃到的！不过啊……"},
		{name:"侦探", context:"不过怎样？"},
		{name:"老汉", context:"你可不能导出乱说啊，我是看你面善，才跟你说的"},
		{name:"侦探", context:"这可是犯法的啊？不怕被抓到吗?"},
		{name:"老汉", context:"哟，你可不要乱说啊，我只是跟你随便唠唠嗑，你可不要随便出去乱说。"},
		{name:"侦探", context:"不会的，不乱说的！"},
		{name:"老汉", context:"这一带地区，条件比较恶劣，人口比较少，很多地方都是无人区。政府的资金不够，所以很多地方监管不到。很多人呀，就想赚这个空子。"},
		{name:"侦探", context:"哦，那老乡，我也想尝尝，这哪里能吃到野牦牛的肉啊？"},
		{name:"老乡", context:"恩，那边有一个肉贩市场，里面有时候会有呢，外面的餐馆儿啊可不敢弄这些，要自己做嘞。"},
		{name:"侦探", context:"恩，那行，谢谢您啦，我去那边儿瞧瞧去。"}
		],
		dialog_3:[
		{name:"侦探",context:"我是上头派来调查最近的野生动物盗猎事件的！"},
		{name:"侦探",context:"就凭你？你知道在我们西藏特别是野外要如何生存吗？"},
		{name:"侦探",context:"当然！"},
		{name:"侦探",context:"如果你能在以下物品里找到正确的所需物品，那么这次的任务我们就可以放心的交个你。"},
		],
		dialog_4:[
		//玩家在找不同中找到了正确的物品出现的谈话内容
		{name:"侦探",context:"很好，这次的任务我们可以交给你，也希望你能帮我们抓到坏人。"},
		{name:"侦探",context:"放心，我必定不负所托！"}
		],
		
		//玩家在找不同游戏中没有找到正确的物品出现的谈话内容
		dialog_5:[
		{name:"侦探", context:"您没有找出所需物品，我们不能将此次的任务交给你，您请回吧！"}
		],
		//玩家在完成游戏后，npc最后的谈话内容
		dialog_6:[
		{name:"侦探",context:"祝您好运！"}
		],
		dialog_7:[
		{name:"侦探",context:"你知道吗，由于最近频繁的盗猎事件，珍稀动物协会发布了新的悬赏任务，谁能完成这项任务，能够得到不菲的奖励呢！"},
		{name:"侦探",context:"珍稀动物保护协会？是你们这当地的组织吗？"},
		{name:"侦探",context:"是的。"},
		{name:"侦探",context:"（内心：让我去看看他们这个什么协会有什么线索吧！）"},
		{name:"侦探",context:"好的，那多谢了！再见"}
		],
		dialog_8:[
		{name:"屠夫",context:"这位先生，刚才我听见你和我们的头说你要买野生的耗牛肉？"},
		{name:"侦探",context:"（莫非他知道点什么？）"},
		{name:"侦探",context:"是的，难道你有渠道？"},
		{name:"屠夫",context:"嘿嘿嘿！不满您说，我们这家屠宰场就有不少的野生耗牛肉！平常都只是卖给信任的人，今天我看你也是很顺眼的，就卖你一点吧！"},
		{name:"侦探",context:"行，你这有多少我就买多少！对了，你们这野生耗牛肉的进货渠道在哪？"},
		{name:"屠夫",context:"这个，，，，，"},
		{name:"侦探",context:"我就顺便一问，你不愿意说那便算了！"},
		{name:"屠夫",context:"其实也不是什么秘密。每隔一段时间就会有些人卖给我们野生耗牛肉，至于他们怎么得到的我也不清楚，他们好像住在城南，你可以去问问"},
		{name:"侦探",context:"那好的，多谢了！"}
		],
		dialog_9:[
		{name:"侦探",context:"你要买我们的耗牛肉吗？"},
		],
		dialog_10:
		[
		{name:"侦探",context:"找到那些人了吗？"}
		],
		dialog_11:
		[
		{name:"系统",context:"您已经死亡！"}
		],
		dialog_12:
		[
		{name:"侦探", context:"我听说你们这里有野生耗牛肉卖？"},
		{name:"屠夫", context:"野生？不不不，，我们这里的都是家养的。有国家的执照，没有野生的"},
		{name:"侦探", context:"那好吧，请问我能在这周围看看吗？"},
		{name:"屠夫", context:"可以，您请随便!"},
		{name:"侦探", context:"好的，多谢!"}
		],
		dialog_13:
		[
		{name:"老板", context:"您想买点什么呢？"},
		{name:"侦探", context:"恩，你好，我想买点治疗肺水肿的药品。"},
		{name:"老板", context:"恩，好的，您要多少呢？"},
		{name:"侦探", context:"恩，买一盒吧！"},
		{name:"老板", context:"好的，给您"},
		{name:"侦探", context:"老板，问一下，最近有没有人来大量的购买这种药瓶呢？"}
		],
		dialog_real_time_animal:
		[
		{name:"系统",context:"拯救到一只动物！"}
		],
		dialog_end:
		[
		{name:"系统",context:"恭喜您已经解救了所有的动物！"},
		{name:"侦探",context:"。。。就这样？？？难道没有什么奖励？？？"},
		{name:"系统",context:"在玩这个游戏的过程中你所学到的知识就是你说奖励！"},
		{name:"侦探",context:"........."},
		{name:"侦探",context:"我能骂你吗？"},
		{name:"系统",context:"你随便。。。哈哈哈哈哈！"},
		{name:"侦探",context:"去死吧你！！！"}
		],
	}
};