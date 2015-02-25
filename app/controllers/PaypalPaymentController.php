<?php

    class PaypalPaymentController extends BaseController {

    /**
    * object to authenticate the call.
    * @param object $_apiContext
    */
    private $_apiContext;

    private $_ClientId = 'AUlSwRAfcw10MuIVrwCDrW4h7qDCyRo_rptAr8vb3AaHYuHcXeadc_MDFnDW';
    private $_ClientSecret='EJcAIxACuK1B7mT9qcbG6O-ghuz59a3jxZftpHDXNb6TUOw54vho8t4P1flm';

    /*
    *   These construct set the SDK configuration dynamiclly,
    *   If you want to pick your configuration from the sdk_config.ini file
    *   make sure to update you configuration there then grape the credentials using this code :
    *   $this->_cred= Paypalpayment::OAuthTokenCredential();
    */
    public function __construct()
    {

        // ### Api Context
        // Pass in a `ApiContext` object to authenticate
        // the call. You can also send a unique request id
        // (that ensures idempotency). The SDK generates
        // a request id if you do not pass one explicitly.

        $this->_apiContext = Paypalpayment::ApiContext($this->_ClientId, $this->_ClientSecret);

        // Uncomment this step if you want to use per request
        // dynamic configuration instead of using sdk_config.ini

        $this->_apiContext->setConfig(array(
        'mode' => 'sandbox',
        'service.EndPoint' => 'https://api.sandbox.paypal.com',
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => __DIR__.'/../PayPal.log',
        'log.LogLevel' => 'FINE'
        ));
    }

    public function create()
    {
        $amounts = User::find(Auth::id());
        $amounts = $amounts->views * 4;

        $payer = Paypalpayment::Payer();
        $payer->setPayment_method("paypal");

        $amount = Paypalpayment:: Amount();
        $amount->setCurrency("USD");
        $amount->setTotal($amounts);

        $transaction = Paypalpayment:: Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription("Payment done to E-Ads");

        $baseUrl = Request::root();
        $redirectUrls = Paypalpayment:: RedirectUrls();
        $redirectUrls->setReturn_url($baseUrl.'/payment/confirmpayment');
        $redirectUrls->setCancel_url($baseUrl.'/payment/cancelpayment');

        $payment = Paypalpayment:: Payment();
        $payment->setIntent("sale");
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);

        //set the trasaction id , make sure $_paymentId var is set within your class
        $this->_paymentId = $response->id;

        //dump the repose data when create the payment
        $redirectUrl = $response->links[1]->href;

        //this is will take you to complete your payment on paypal
        //when you confirm your payment it will redirect you back to the returned url set above
        //inmycase sitename/payment/confirmpayment this will execute the getConfirmpayment function below
        //the return url will content a PayerID var
        return Redirect::to( $redirectUrl );
    }

    public function getConfirmpayment()
    {
        $payer_id = Input::get('PayerID');
        $payment_id = Input::get('paymentId');

        $payment = Paypalpayment::getById($payment_id, $this->_apiContext);

        $paymentExecution = Paypalpayment::PaymentExecution();

        $paymentExecution->setPayer_id( $payer_id );

        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        //check your response and whatever you want with the response
        //....
        $views = Viewz::whereHas('ads',function($q){
            $q->where('user_id','=',Auth::id());
        })->get();
        foreach($views as $view){
            $view->payment_advertiser = 1;
            $view->save();
        }
        return Redirect::route('advertiser-dashboard');
    }


    public function getCancelpayment()
    {
        return Redirect::route('advertiser-dashboard');
    }
}