<!--搜索开始-->
<div class="banner" >
<style>
.index-box {
	width: 100%;
	height: 610px;
	background: url(/assets/images/bj.png) center;
	background-size: cover;
	position: relative;
	margin-bottom: -250px
}

.index-box::before {
	content: '';
	left: 0;
	top: 0;
	width: 100%;
	height: 600px!important;
	background: rgba(51,51,51,.1);
	position: absolute
}

.index-box .tit {
	text-align: center;
	padding: 110px 0 0;
	color: #fff;
	z-index: 99;
	position: relative
}

.index-box .tit h2 {
	font-size: 50px;
	letter-spacing: 5px;
	color: #fff
}

.index-box .tit p {
	margin-top: 15px;
	font-size: 20px
}

.index-box .search-box {
	width: 760px;
	height: 60px;
	margin: auto;
	background: rgba(255,255,255,.25);
	border-radius: 40px;
	z-index: 99;
	position: relative;
	padding: 10px;
	margin-top: 25px
}

.index-box .search-box .txt {
	width: 615px;
	height: 40px;
	border: 0;
	border-radius: 20px 0 0 20px;
	text-indent: 10px;
	background: #fff
}

.index-box .search-box .iconfont {
	width: 125px;
	height: 40px;
	border: 0;
	background: #007bf5;
	border-radius: 0 20px 20px 0;
	color: #fff;
	float: right;
	cursor: pointer
}
@media screen and (max-width:767px) {
	.index-box {
	width: 100%;
	height: 610px!important;
	background: url(/assets/images/bj.png) center;
	background-size: cover;
	position: relative;
	margin-bottom: -100px!important;
	margin-top: -26px;
	}

	.index-box,.index-box::before {
		height: 18rem;
		margin-bottom: -45px
	}

	.index-box .tit {
		padding-top: 5rem
	}

	.index-box .tit h2 {
		font-size: 1.5rem
	}

	.index-box .tit p {
		font-size: 1rem
	}

	.index-box .search-box {
		width: 90%;
		height: auto;
		overflow: hidden;
		border-radius: 1rem
	}

	.index-box .search-box .iconfont,.index-box .search-box .txt {
		width: 100%;
		border-radius: .8rem
	}

	.index-box .search-box .iconfont {
		margin-top: .5rem
	}
	.banner {
    height: 300px!important;
    padding-top: 25px;

}
</style>

<div class="index-box">
<div class="tit night-color">
<h2>全网最全的资源导航网</h2></div>
<div class="search-box">
<form action="/" method="get">
<input type="text" placeholder=" 牢记我们的域名 <?php echo getDomain(OZDAO_URL); ?> 别迷路哦"  name="keyword" autocomplete="off" class="txt night-bg" required="required">
<input type="submit" class="iconfont" value="本站搜索">
</form>
</div>

</div>
</div>
<!--搜索结束-->