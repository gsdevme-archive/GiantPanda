<!doctype html>
<html lang="en">

	<head>
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
		<style>
			h1,h2,h3,h4,h5,h6,p,li,ul{
				padding:0;
				margin:0;
				line-height:normal;
			}

			body,html{
				margin:0;
				padding:0;
				font-family: Helvetica, Arial, sans-serif;
				background:#FAFAFA;
			}

			.container{
				width:960px;
				margin:0 auto;		
			}

			header{
				background:#2E5A5C;
				padding:10px 0;
			}

				header h1{
					font-size:26px;
					font-weight:300;
					color:#FAFAFA;
				}

				header h4{
					font-weight:400;
					line-height:26px;
					font-size:13px;
					color:#FAFAFA;
				}

				header img{
					position:absolute;
					margin:-53px 0 0 920px;
				}

			#title h1{
				padding:20px 0 0 0;
				line-height:45px;
			}

			#title a{
				display: block;
				padding:0 0 20px 0;
				color:#303030;
			}

			article{
				display:block;
				width:100%;
			}

				article h2{
					font-weight:400;
					font-family: 'Droid Sans', Helvetica, Arial, sans-serif;
					font-size:18px;
					line-height:32px;
					text-transform: capitalize;
				}

				article h2 a{
					text-decoration:none;
					color:#303030;
				}

				article h4{
					font-weight:300;
					font-size:12px;
					color: #666;
				}

				article pre{
					display:block;
					width:98% !important;
					padding:10px 1%;
					border:1px solid #dedede;
					background:#fafafa;
				}

				article pre:last-child{
					display:none;
				}

			footer p{
				line-height:42px;
				font-size:11px;
				color:#575757;
			}
		</style>
	</head>

	<body>

		<header>
			<div class="container">
				<h1>Giant Panda</h1>
				<h4>A PHP 5.3.3+ Framework to implent the MVC architecture</h4>

				<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAUB0lEQVRogbWaeZRc1X3nP/e+/VVVd1d1t7pbAqklGUtiEYux2cZ22AxxsA1JhgQvxz6eic8Zh8xMnPjEiSeJJ2dwzoxniYkxE5JxnDgmYGPHgAeCDTGDkAQGzGIJkBQhtdRaeq/1rXeZP6qlgxAyjO2559Q5Va+q3v197/0t39/3PmGt5dgQQvDzHH/wmU9/bc+eXdf2esmI47jzz7/w48dWrRz/V9uffKb5s9z3BJv/fwH401v+5GuPPPLwh5eaLUDQ6XSQ0qHX604ND9fPe+75nT81iDcEcPE7LpicnFz3B3G1OqKV5v777//U4lJz/5ud4EO/fsPQzMzCoX1TU3GS5szPzSOkxBjD+PgYWDM1fejI5M8DgHztl3/237/wF1Fc2bf3lVd+Y+vWrTc89L3v3SCksy8Mw8+92QnKUl3fS5JYaUO73UFpTRzHaK1ZWFikNjCw5obr33f9Twvg1cN99Yc//Oxnfuehh/7xE0tLTdIsZ+/efQghUEpRq9U+nWXZV4H9x36/Zcs/TVrLpLUWYzTWGLTR3Ppnt35caYXn+TiOw4oVK8iyjCiKyPOcw4cO40jOA77zcwXwzDNPf2Z2do6lpSUWl1porRkaGqLZbJJlWbx69eo/v/322+6r14eudxznsjAMBq2FIPAxRqOUoshzrr/+A3zjG/dw4OBh2u02UkrCMKQsS7TWeJ7Pxz72sX99yaWX1Lc+/tizzz/77HNfv+sfnvuZASwsLIxoY4iiGNnqUKlUaDabCCHQWiOlvM73vevGx8cYHh7GGIMQgjzPKYqCIPBpt1pccdUV1Bt1vvzlO9DasLCwgO/7DAwMUKvVWL9ukiuuuHxVpRr/20svu4zNmzdz4dsvTFutzpOjoyv+7jd/61P/680COCEGJibGGRoaotPp0G63sdYyNDREFEVorbn44ovYvHkzjcYwShk8L6DISzzPp1ar4TgunucTBCEXvv1C7rjjS/zRH/4+q1atwvd9FhcXsdZwzjlnMzY+RhiGTEyMs3bdJBdfekn0tgvP+4WDBw/81Uc+dOOOf/nL73/HmwFwQhY6+8wNL0rpbOr0eqRpzuzsLEEQsHbtWj73uT/immuuwXNd0izD8zyU0kRRiLUWozVaK5RWqLJAaUWa9ADLjp07+fwt/5V2p8U5Z29i585dbDpzE7//mU/jOII4jkiSHlJKlC7ZtvUJ7rv3f3PRxZfedsvn//PNrzX6lGn0qiveed6BA4e2BmEYtzs9er0ea9eu5c47/5aJ8ZU4roMQEsdxSJKEOK6QJAlBEJAkXZRSWGvI8wzPc+l2O0gpKMuCXrfDjp0vEQYujz66lW996z42nbmRP/mP/4EVY6MURYE1GqVKkjThR888z333PsD69W959K++8jeXnwrACS70yA8ef25oaPCysbEV82WRs2rVSu68828ZGqxTqpIkSTHGIqVDGEZYa6lUKstBGuG6HkEQEscVyrIkDCOyLKcsS6R02LTxDFaunOA973k3Y2MrmJo6wL/55L9jYWERgUUpRZ7neK7LhReey/kXbGbXrpd/4Xc/9e+/9KZc6Fgh+/73H/hknue3nXvuuVTiCtaCNpY4ruB5HsZYhBD4vk+73cZ1HfI8Iwj85UxT0ut2kU6/AgssSdqjyDPAkKQpd9/9bR55eAtHjh7lPVdfyR//8e+htEIrRavdxvddOu0uX/3rrzM/v4ix9rLHtz657SfuwPGLUvzexo0b8H2fLMuQjoPjOLiuS5qmx7NPr9ejWq1SliW+7wOQZSlpmiJl/9ZB4COlQC5XYiEEUsIVV7yTVqtFHMVseXw73/nOd8nSFGM0cRTS7XSpVELec83ltDtdFhebX39dW1974YEH/uF6KeRqR0q63S6e55Mk6fFcb61FSkFRFMRxRJomxHGM4zgYYwCB1gaL5dhCWUArhbWWLCuQQlKrxWzYsB4EuI7DN++5jyzLaDbbZFmKEJKiKBgbGyUKA6w1kx/9yIc+94YAtFLXDI800FoTxxEIiOMQayxYSxD4OI4kDHxarTZa62VghrIoEQKEYBmQRmtNURT4vr+8SwatNY6UnH32RoYGBynKkqmpKV7etYdqNcJ1XSyaNM0IQ59/8c6LCIKAF378wkePufqx10kAsjw/x3UcXM+lKAq6nb6R7U4bvbwDaZrS7nQwpm98lqWUZYm1ZjkTWbIswxpDWRSossRYA1gcx0EIKEvFW94ySZqlKFXiui7f/e5DaKPpdruUpeoDsYaVK8dQSlMUxeSll7z9hPrgvhaAMWZEG0VZFLheQBiFFHmO67gopTCmwFpLGEZ997Cm72quS17kuI7k4Yf+kce3bOH0NZO8613vot6o99OktShlMMZgjGZ4eAgp+jQjyzIOTE2T9HqEoY/qKlxXYoxm/fo1ZFlGHEU0m+3fAX7tdQFcf901k512a4PrOAgpKMscpUqqlSppmoCApYU5ntj2OI4X8N7r3n98RY01qLKkk/b4+7vuYd+hg9gfPsVDDz3CzTd/grdu2EBpNFJa0rTAdR0ajSGU1v2iWCqmDkwjhMAYQxh6FEVBUZT4fr94aq1RSp11yh0I48qXG416v0iJfjBK6ZJmKVEUsTB3lC/+j//GC/tfxkpNWIm5+KJLAIHrOviBx8xMk1a3zYc/8RH27NjLj559ii9+8XZ++7c/yWmnn4Y2GulAnikWF5vUhwY5enQGpRRZljE3v8CK0cbyLoHjOstcq8RojZTOilMG8fT09KTrOkhHYLTG81ykhLIsyNKEr/3NV9j6o2f4xfe9jzPWnMO9D3wbYwxRFOJ5AVhBGAQ0Bgd4+MGH2TO1ByEls/NL/NMjP6DX65GlGUWeA5ZWq4MQglIpKpUKw8PDHD1ylF4vIUkypIQiz1FKLxNKg+s6o6cEUOTFyMED05RFQZom9LpdBOBIwb69u9my7SmKVHH3N+9i+xPb8KRPUWRI6WCMBSHwgoCbPngTC4fnWDg8R3euhzGGl1/ejeNIyrJYjh3LzMw8i4uLOI6DNvpYDCKExff7ARyGAQcOHEYrjZTyeH15XQCVajy6d+8rGKtRWiEklKogL3JeenEns3OLlLkmPVJgM8v7f+kGjOlzH9/3j9eDybVruO7aq3GUxFqLEOAHHlqXWOxy5srZvv0ZBIIw8InCsO821pJlOdaa/qIWij3/vA8Az/OOgz9WjU+IgSAI2bbth1xz7ZUMDg6itUIA0nGZnZtbLlT9G5w2sZIzzliLlOC6HlIKVNnP+VmWctXVlxOFLk8++QxCCC697B30el2E6P//8JEZpqamsUC1WmN+foG8KLDWUKnEFEWBlBLfd9m9+5V+YcRSFOVxe621JwLwfY8VK0bY8tg2rv3Fq8jynEocI41mfGIlruuglCLwfX7pvVdTFgVYS5YmeJ5PUea4joM1hm63w/lvO58L3nYBQoLjuJSqQCsFwMPff5w4jijLktnZOfzAx/N98qzvYq7rUhSKokh5+ukXCAOfLMsJAr/3aptPALC41JyrVauj27b/kLPO3sDKlSvpdNqEYcjmczfzWzf/Bs8++wIb3rqeK6++CoumKDRZnqKbhjAMsRZc18F1Zb/iOhIpHZQqsMaglOaRR7Zy5MgscRTT7SVEcUi73UFrg+/3TeozXJ/HHnvyuGvpvKBSqew/JQCt9PzgQG109z/Pcs899/Pxj3+QIPApihzX9di46a1ccMF5ZFlOUWQACARJr0eWt0mSpJ+xMoW1UBY5ubWEYUCeF2itefDBR5naf4hms0Ucx1SrVdRygPp+/3evHt/69oM4y4FrraXI81MDmJiYoJekDNRqzM7Mc+utf8mNN76P1atPxxiNIx2SpIvneWRpAkCzmfDjHduZmpqi1WqRZRmDg4Nc9I7NTEwM4gjB7Mw8u3fv49FHtxFFESCwxrC4uEgUxXQ6HbTWaG0Igj6rNcZw1133MjMzi+/5eJ6Hlhrg/lMCsJaeUiW1Wj+out2EL3zhdi666AKuvPJdNIYH8VwXYzVloRDC0um0eOqpJ9iyZRv1ep08T/ngTR9gbGwAay1fvv1r7N93AM/1qFRjilIRhiEDg4OA5cjRGRwpKS0gYHR0BKUU+/ZN8517v9cnhdYihUBZSxCGB04JYMfOHVNnnbnxwqVmi2arxcjICGEY8NxzO9i27WlGRuqsW7ca1/NYOTHGxRefT60W8uEPXcfbL3wL3/v+Ni679CzWrJ7AcSR79uzn0PRRfD9AqZI8ywmDkHarRa/bpZekqFIRRhHGWEqlGB8fZWpqmls+f2u/eeqrIdjlXel2OukpAaycGPvu4lLzVwLfY3BwgLm5eaIoYmZmBikF+6d6HDo8w9zsHEEY8uKLu/joR3+V+fl5Dh8+wuCAy+7d+1hcTLnkkiqP/mA7nU6HOI4ZGhoiTRJarTZFWeK4LmNjK5g+dJjA73dyo6MjbN36FF/567v7jZSUIESfaxlDGAQndGMnu5Cx+0tVkKYpQRDg+/38PrZilOlDhynLkmqtRhAGOI7kgQcfoSwVN910HaOjI/R6PSqVmDPOWMfU1CF27d6LHwRUqxVc10VIh0Z9iG63hwVmZmawxjA7N4fruCw1W/z5l766XPwESml83++/LxVRrUpRnhjkJ/XEm88500oBaZZTrw9x6NARBgZqGANz8/MYYyiKAsdxjnF03v3uS/jA+y9H6wKtNC/vOsCDD/4f8rwgjEIwBs/3GRwcwPM8rLUsLTVJ0xSERClFmqbkeYHruhhj+kKAEMRxDKJvm+s6SCHrR2dmjyvbJ/UDKycmpg4enF6zauVKkqTvbsbCwsICYhmk1uZ4+zg4OMizz+7gsce2c9ZZGzh0aIaiKBgZHsZ1PXzfWxYLbL+rA5aWmlQqFRYXlyjKkiAIgL5IcGz1Xdfpz20Mruv25ZminGu22ifI8id1ZHlRvIigr2k6/UZ8YX6BIPCJoogszYjjCKUUURTR6/Vecl3314eG6smuXXtxXRfXcSlVSbvdptPpUpYlIMiyviCgtWZmZpah+hD1ep12u0Oe50gpcZz+y/cDfN/vB7C1aK1pNBo7X2vvSQC63fYdfXZoWFpawnVdxsfHKJUmSRMaww3SNF2uupYsy947MzN79/z8/G9qrdFKY6xhaXEJCzSGGwAM1KpEUYxAkGVZf1WFZG5unvHx8QOOlLiOc5xxuu5yRXYkor/1VCqVv3hDAMCjjfoQlbhCkqQ0Gg2yPMf3+1JinufEcUye57Tb7cRau395q7/qSCfp9XpUK1WW0zrtVhuAufkFXM/l8JEjDA8Po5RiYXGRKAqZm5vd7vv+MlM1yxJMv/HHgud7DNRqcz/esfOuNwTw1NPPN+NKdUobhe97zM3PUSyTtmq12m/WraVer1Ov16fWrV7jrD19dTB52ulViz1orT3OJBECx3EYHm4wMT7O7OwsjuPQbDaJ4xjP80jTdCmOouel0zdlWQWnLBWO048DgWD16tWve5bwusJWu926rcgLhoeHscaS9HqUpSIMAqSQRGHYn0DKUa31oNK6obQertUGnEq1QrvTZsXoKEEQEAQ+SZJgjGZoqE6jXidJUubm52m1WlTiyhP1ev1X7XKwAhhtiMIAx3UBi+d5ySt793523ZrJkw7xXhdAp9P5plKa2dlZAEZHR8mLnG6vy+DQIEmakmUpvSQZUVo3lFLDSqnRVqvpdrtdRkZGmJmZwXNdlpaauI5Ht9fDWku31yOKIqSUBEFQaK3vabfb64UQ+J5HHEV4nocfBLiOxPd9Nm7c+Hnf9TtYexKAk9IowPMvvLh//brJl3zP31Sr1ShLxdDgIK12B2syiqIkiiK63R7tbueiMAgPGmOigYFBJwwDiqJACIHne8vqRkGlWqHd7oIQZHmGIx2CIHg2z3J55llnDUopadQb7HxxB91Ot+9KjiSuVJ7Z8/Lu24SUlr7I98Y7ABCG/if1MmPsH0xYhhsN0izFcSRpkhL3Dz42G61r2ugB1+0rBmmaMja2Atdx0ErR7nQ4eHAaa21fzVMapVWZJsn9p5122qrp6Wk6nS5Hjh7B6H4RcxyHer2xK+ul/wmoCFCvHJg6CcBPPCdetXLiRceRm44Fb5pmpMscJU37Ra5ebzyY9pI7lFarLXyxWq1QiWOKop+tKpXKcZrd7SX4nkeSZlSr1Sd1Wf4liEXfdzdJKc8tinIUgXRd94g19hmBeN51nd2OdA7vO3jgeC/5aptf14WOjWocX6aMni7LIgZBtVpZVucMZ555JouLiwRBWMvTVK1bs+7aozNHkUIc50y9bhdjLL7v9wmclCRpRqPRWMjT9H86jjMPLBhj92Htt33PL6UQpZAyl65IhBAZp1j5NwVAlbqJtOcNDNS/0Wo1z0uShBtv/DWEECwtLTE/P8+2bdumK1EsDx48eJaxBt/zllUFSxxHy9ypJM8LLOB5bt5utW6pRPFBIcQC0JFC5EKKQgiZCyFKKUQB6J9k+LHxho8arFu9RlpwS118LE2zm6vV2jlFWeL2JcW9RV58Ns9zuf6MM+7cteslatUaCMHgQA0hBNZakiSl1WrjBwFG6/8S+cE3hJQtoC2EyIUQpYBSCKFfOTBl3sjon+pZiXWr1zjWWicv89GiLM8BkkoY77LWWmXNp9dMTv7uxMQEo6OjHDl8mG3btlJv1Om021gryIu8GKgNfEFY+xWBaAkhekKIEjBvZqV/ZgDHgayZFMv5WCz/X8wtzk9Kx90ax9FoHFeIwoBDhw4xMDDA3Pw8QRC+KBF3VKLocdd1XxZCJP+vRv/cAPykMVCrni+kOEMKcZ4QssAy5TjOK77rHZGOM+86TmvfwQP6Z5qEEwH8X87VD5ggnta4AAAAAElFTkSuQmCC"/>
			</div>
		</header>		

		<div class="container">
			<div id="title">
				<h1>Develop Branch Commits</h1>
				<a href="https://github.com/gsdevme/GiantPanda">GitHub Project</a>
			</div>

			<?php if(isset($feed)) foreach($feed as $commit): ?>
				<article>
					<h2><a href="<?php echo $commit->link; ?>"><?php echo $commit->title; ?></a></h2>
					<h4><?php echo date("F j, Y, g:i a T",strtotime($commit->updated)); ?></h4>		

					<?php echo $commit->content; ?>					
				</article>
			<?php endforeach; ?>
		</div>

		<footer>
			<div class="container">
				<p>Panda Image Taken From: http://www.iconfinder.com/icondetails/19225/48/</p>
			</div>
		</footer>
	</body>
</html>		