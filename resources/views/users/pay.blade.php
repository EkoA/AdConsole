<html>
<head>
	<title></title>
	<script type="text/javascript">
	/*function myfunc ()
	{
		var frm = document.getElementById("gtpay");
		frm.submit();
	}*/
	</script>
</head>
<body onload="document.submit2gtpay_form.submit()" >
Transaction ID: {{$gtpay_tranx_id}}

<form name="submit2gtpay_form" action="https://ibank.gtbank.com/GTPay/Tranx.aspx" target="_self" method="POST" id="gtpay">
	{{ csrf_field() }}
	<!--<input type="hidden" name="gtpay_echo_data" value="DEQFOOIPP0;REG13762;John Adebisi: 2nd term school and accomodation fees;XNFYGHT325541;1209">-->
	<input type="hidden" name="gtpay_mert_id" value="{{$gtpay_mert_id}}" />
	<input type="hidden" name="gtpay_tranx_id" value="{{$gtpay_tranx_id}}" />
	<input type="hidden" name="gtpay_tranx_amt" value="{{$gtpay_tranx_amt}}" />
	<input type="hidden" name="gtpay_tranx_curr" value="566" />
	<input type="hidden" name="gtpay_cust_id" value="{{$gtpay_cust_id}}" />
	<input type="hidden" name="gtpay_cust_name" value="{{$gtpay_cust_name}}"/>
	<input type="hidden" name="gtpay_tranx_memo" value="{{$gtpay_tranx_memo}}"/>
	<input type="hidden" name="gtpay_no_show_gtbank" value="YES" />
	<input type="hidden" name="gtpay_echo_data" value="{{$gtpay_echo_data}}"/>
	<input type="hidden" name="gtpay_gway_name" value=""/>
	<input type="hidden" name="gtpay_hash" value="{{$gtpay_hash}}"/>
	<input type="hidden" name="gtpay_tranx_noti_url" value="{{$gtpay_tranx_noti_url}}"/>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="submit" value="Pay Via GTPay" name="btnSubmit"/>
	<input type="hidden" name="gtpay_echo_data" value="">
</form>
</body>
</html>
