<div id="trueinsight-activation-form-container">
<div id="trueinsight-activation-form-container-inneer">
	<form id="trueinsight-activation-form" method="post">
		<div class="trueinsight-form-inputs">
			<div class="trueinsight-form-inputs-inner">
				<img class="trueinsight-icon-bg" src="https://trueinsights.co/images/v2/icon-1024x225.png">
				<h3>Sign up</h3>
				<label>Email Address</label>
				<div><input type="email" name="trueinsight-email-input" placeholder="admin@example.com" required="" value="<?php echo esc_attr($admin_mail); ?>"></div>
				<button class="button button-primary">Activate</button>
				<div class="terms">
      <p>By signing up, you agree to <a href="https://www.trueinsights.co/terms-of-use" target="_blank">terms of use</a>.</p>
    </div>
			</div>
		</div>
	</form>
</div>
</div>
<style type="text/css">
	#trueinsight-activation-form-container {
		height: 100vh;

		/*background: url('https://static.wixstatic.com/media/090a9d_304d9b78e812414aa33cd35002a21b33~mv2.png/v1/fill/w_600,h_412,al_c,q_85,usm_0.66_1.00_0.01/090a9d_304d9b78e812414aa33cd35002a21b33~mv2.webp');*/
		background-size: cover;
		background-repeat: no-repeat;
	}

	#trueinsight-activation-form-container-inneer {
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100vh;
		background: #f0f0f1e8;
	}
	.trueinsight-form-inputs {
		width: 400px;
		/*margin: 178px auto;*/
	}
	.trueinsight-form-inputs h3{
		text-align: center;
		font-size: 1.5rem;
		color: #334E67;
	}
	.trueinsight-form-inputs label{
		font-size: 18px;
		color: #617D97;
		font-weight: 700 !important;
	}
	.trueinsight-form-inputs input{
		margin-top: 10px;
		margin-bottom: 10px;
		display: block;
		width: 100%;
		padding: .375rem .75rem;
		font-size: 1rem;
		font-weight: 400;
		line-height: 1.5;
		color: #212529;
		background-color: #F0F4F8;
		background-clip: padding-box;
		border: 1px solid #D9E1EC;
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		border-radius: .25rem;
		transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	}
	.trueinsight-form-inputs .terms {
		text-align: center;
		font-size: 1rem;
	}
	.trueinsight-form-inputs button.button{
		width: 100%;
		background: #3557cc;
		border-color: #3557cc;
	}
	.toplevel_page_TrueInsights img.trueinsight-icon-bg {
		width: 100%;
	}
</style>