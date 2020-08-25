<?php

namespace Hamrahpay\Laravel\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static Amount($amount)
 * @method static CallbackUrl($url)
 * @method static CustomerName($customer_name)
 * @method static Email($email)
 * @method static Mobile($mobile)
 * @method static Description($description)
 * @method static AllowedCards($cards=[])
 * @method static Wages($wages=[])
 * @method static PaymentRequest()
 * @method static VerifyPayment($payment_token)
 */
class Hamrahpay extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Hamrahpay';
    }
}
