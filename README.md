# [Hamrahpay](https://hamrahpay.com) Composer Library 

[Hamrahpay](https://hamrahpay.com) Online Payment Gateway PHP Composer Library

## Usage

### install
```bash
composer require hamrahpay/hamrahpay
```

### Pay Request
```php
use Hamrahpay\Hamrahpay;

$api_key        = 'YOUR-API-KEY';
$callback_url   = 'HTTPS://YOUR-CALLBACK-URL.COM/CALLBACK';
$hamrahpay = Hamrahpay::Instance($api_key);
$result = $hamrahpay
    ->Amount(10000)
    ->CallbackUrl($callback_url)
    ->CustomerName('علی')
    ->Description("تست")
    ->Email('test@eample.com')
    ->Mobile('09121234567')
    ->PaymentRequest();

echo json_encode($result); // show result data
echo $result['payment_token']; // save it for verification after payment


// redirect to payment page
if (!empty($result['status']) && $result['status']==1)
    $hamrahpay->Redirect();
```

### Verify Payment
```php
use use Hamrahpay\Hamrahpay;

$api_key        = 'YOUR-API-KEY';
$hamrahpay = Hamrahpay::Instance($api_key);
$payment_token  = $_GET['payment_token'];
$status         = $_GET['status'];

if ($status=='OK')
{
    $result = $hamrahpay->VerifyPayment($payment_token);
    if ($result['status']==100) // succeed , first time verification
    {
        echo "<br> Reference Number:".$result['reference_number'];
        echo "<br> Reserve Number:".$result['reserve_number'];
        echo "<br> Amount:".$result['amount'];
    }
    else if ($result['status']==101) // succeed, after first time verification
    {
        echo "<br> Amount:".$result['amount'];
    }
    else
    {
        // show error message
        echo $result['error_message'];
    }
}
else // NOK
{
    // show error
    echo "NOK";
}
```
### Get Unverified Transactions
```php
use use Hamrahpay\Hamrahpay;

$api_key        = 'YOUR-API-KEY';
$hamrahpay = Hamrahpay::Instance($api_key);
$unverified_transactions = $hamrahpay->getUnverifiedTransactions();

print_r($unverified_transactions);
```

## Laravel Usage
this library is also ready to using with laravel, it works with all versions of laravel.

**if your are using laravel 5.5 or below, Add Provider in "config/app.php"**
```php
'providers' => [
    ...
    Hamrahpay\Laravel\HamrahpayServiceProvider::class
    ...
]
``` 
then add this to `config/services.php` 
```php
'hamrahpay' => [
    'API_Key' => 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX',
],
```
Or create `config/Hamrahpay.php` and add this
```php
return [
    'API_Key' => 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX',
];
```

now it's ready to use
```php
use Hamrahpay\Laravel\Facade\Hamrahpay;

$callback_url   = 'HTTPS://YOUR-CALLBACK-URL.COM/CALLBACK';
$result = Hamrahpay::CallbackUrl($callback_url)
    ->Amount(10000)
    ->CustomerName('علی')
    ->Description("تست")
    ->Email('test@eample.com')
    ->Mobile('09121234567')
    ->PaymentRequest();

echo json_encode($result); // show result data
echo $result['payment_token']; // save it for verification after payment

// redirect to payment page
if (!empty($result['status']) && $result['status']==1)
    Hamrahpay::Redirect();

```

verification in callback method in your controller
```php
use Hamrahpay\Laravel\Facade\Hamrahpay;
$payment_token  = $_GET['payment_token']; // $request->get('payment_token'); or Input::get('payment_token');
$status         = $_GET['status']; // $request->get('status'); or Input::get('status');
if ($status=='OK')
{
    $result = Hamrahpay::VerifyPayment($payment_token);
    if ($result['status']==100) // succeed , first time verification
    {
        echo "<br> Reference Number:".$result['reference_number'];
        echo "<br> Reserve Number:".$result['reserve_number'];
        echo "<br> Amount:".$result['amount'];
    }
    else if ($result['status']==101) // succeed, after first time verification
    {
        echo "<br> Amount:".$result['amount'];
    }
    else
    {
        // show error message
        echo $result['error_message'];
    }
}
else // NOK
{
    // show error
    echo "NOK";
}
```
sometime in many reasons your server failed in get result of transaction, then you can get unverified transactions and verifing them

get unverified transaction 
```php
use Hamrahpay\Laravel\Facade\Hamrahpay;
$unverified_transactions = Hamrahpay::getUnverifiedTransactions();
print_r($unverified_transactions);
```

[Hamrahpay.com](https://hamrahpay.com)