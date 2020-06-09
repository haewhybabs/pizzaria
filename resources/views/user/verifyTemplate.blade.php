<style type="text/css">
	.title{
		margin-top: -40px;
    font-size: 20px;
    color: #aeaeae;
	}
	.footer{
		color: #aeaeae;
		margin-bottom: -35px;
    padding-top: 10px;
	}
	.border-div{
		font-family: calibri;
		border: solid wheat 25px;
		padding: 15px;
	}
</style>
<div class="border-div">
	<div class="title">PizzaPizzaria</div>
	<h3>Hello {{ $name }},</h3>
	<p>
		Thank you for registering on our site. Please use the below verification code to complete the registration process.
	</p>
	<p>
		Verification Code: <strong>{{ $code }}</strong>
	</p>
	<div>
		<p>Support Team,<br>
			<a href="{{ url('/login') }}">Pizzapizzaria</a>
		</p>
	</div>
	<div class="footer">© 2020 PizzaPizzaria</div>
</div>
