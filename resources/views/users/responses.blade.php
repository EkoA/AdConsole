@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Response</div>

                <div class="panel-body">

                    <?php
                    $class = "alert alert-success";
                    if($gtpay_tranx_status_code != '00'){
                        $class = "alert alert-danger";
                    }
                    ?>

                    <div class="{{$class}}">
                        <?php if($gtpay_tranx_status_code == '00'): ?>
                            Transaction Successful.
                        <?php else: ?>
                            Transaction was not successful.
                        <?php endif; ?>
                        <br>
                        Customer: {{$customer}}<br>
                        Transaction ID: {{$gtpay_tranx_id}}<br>
                        Reason: {{$gtpay_tranx_status_msg}}<br>
                        Amount: {{ $gtpay_tranx_amt }}<br>
                        <?php echo date('Y-m-d'); ?> <br>

                        <?php //if($gtpay_tranx_status_code == '00'): ?>
                            <a href="{{url('/login')}}">Click here to Continue</a>
                        <?php //endif; ?>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
