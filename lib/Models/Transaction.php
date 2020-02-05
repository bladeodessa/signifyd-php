<?php
/**
 * Card model for the Signifyd SDK
 *
 * PHP version 5.6
 *
 * @category  Signifyd_Fraud_Protection
 * @package   Signifyd\Core
 * @author    Signifyd <info@signifyd.com>
 * @copyright 2018 SIGNIFYD Inc. All rights reserved.
 * @license   See LICENSE.txt for license details.
 * @link      https://www.signifyd.com/
 */

namespace Signifyd\Models;

use Signifyd\Core\Model;
use Signifyd\Models\Address;

/**
 * Class Transaction
 * A list of payment instruments and associated payment details used to pay for the order.
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   bladeodessa <bladeodessa@gmail.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Transaction extends Model
{
    /**
     * If there was a previous transaction for the payment like a partial AUTHORIZATION or SALE, the parent id should include the originating transaction id.
     *
     * @var string
     */
    public $parentTransactionId;

    /**
     * The unique identifier provided by the payment provider for the payment.
     *
     * @var string
     */
    public $transactionId;

    /**
     * The date and time when the transaction was processed by the payment provider.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The name of the payment gateway or financial institution that processed the transaction.
     *
     * @var string
     */
    public $gateway;

    /**
     * The funding source used to complete the payment.
     *
     * @var string
     */
    public $paymentMethod;

    /**
     * The type of transaction that was processed by the payment provider.
     *
     * @var string
     */
    public $type;

    /**
     * The status as returned by the payment provider when the transaction was submitted.
     *
     * @var string
     */
    public $gatewayStatusCode;

    /**
     * Additional information provided by the payment provider describing why the transaction succeeded or failed.
     *
     * @var string
     */
    public $gatewayStatusMessage;

    /**
     * If the transaction resulted in an error or failure the enumerated reason the transcaction failed as provided by the payment provider.
     *
     * @var string
     */
    public $gatewayErrorCode;

    /**
     * The currency type of the payment, in 3 letter ISO 4217 format.
     *
     * @var string
     */
    public $currency = 'USD';

    /**
     * A positive integer representing how much the payment method was charged.
     *
     * @var string
     */
    public $amount;

    /**
     * The response code from the address verification system (AVS).
     *
     * @var string
     */
    public $avsResponseCode;

    /**
     * The response code from the card verification value (CVV) check.
     *
     * @var string
     */
    public $cvvResponseCode;

    /**
     * The response provided in reason_code by Paypal if the payment_status is Pending.
     *
     * @var string
     */
    public $paypalPendingReasonCode;

    /**
     * The response provided by Paypal for protection_eligibility.
     *
     * @var string
     */
    public $paypalProtectionEligibility;

    /**
     * The response provided by Paypal for protection_eligibility_type.
     *
     * @var string
     */
    public $paypalProtectionEligibilityType;

    /**
     * Information about the payment method as submitted by the purchaser during checkout.
     *
     * @var \Signifyd\Models\CheckoutPaymentDetails
     */
    public $checkoutPaymentDetails;

    /**
     * If the payment method requires an account to use, the information pertaining to that payment account should be provided
     *
     * @var \Signifyd\Models\PaymentAccountHolder
     */
    public $paymentAccountHolder;

    /**
     * The billing address for the card
     *
     * @var Address
     */
    public $billingAddress;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'parentTransactionId',
        'transactionId',
        'createdAt',
        'gateway',
        'paymentMethod',
        'type',
        'gatewayStatusCode',
        'gatewayStatusMessage',
        'gatewayErrorCode',
        'currency',
        'amount',
        'avsResponseCode',
        'cvvResponseCode',
        'paypalPendingReasonCode',
        'paypalProtectionEligibility',
        'paypalProtectionEligibilityType',
        'checkoutPaymentDetails',
        'paymentAccountHolder',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'parentTransactionId'             => [],
        'transactionId'                   => [],
        'createdAt'                       => [],
        'gateway'                         => [],
        'paymentMethod'                   => [],
        'type'                            => [],
        'gatewayStatusCode'               => [],
        'gatewayStatusMessage'            => [],
        'gatewayErrorCode'                => [],
        'currency'                        => [],
        'amount'                          => [],
        'avsResponseCode'                 => [],
        'cvvResponseCode'                 => [],
        'paypalPendingReasonCode'         => [],
        'paypalProtectionEligibility'     => [],
        'paypalProtectionEligibilityType' => [],
        'checkoutPaymentDetails'          => [],
        'paymentAccountHolder'            => [],
    ];

    protected $objectFields = [
        'checkoutPaymentDetails',
        'paymentAccountHolder',
    ];

    /**
     * Card constructor.
     *
     * @param array $item The card data
     */
    public function __construct($item = [])
    {
        if (!empty($item) && is_array($item)) {
            foreach ($item as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }

            if (isset($item['checkoutPaymentDetails']) && !empty($item['checkoutPaymentDetails'])) {
                $checkoutPaymentDetails = new CheckoutPaymentDetails($item['checkoutPaymentDetails']);
                $this->setCheckoutPaymentDetails($checkoutPaymentDetails);
            }

            if (isset($item['paymentAccountHolder']) && !empty($item['paymentAccountHolder'])) {
                $paymentAccountHolder = new PaymentAccountHolder($item['paymentAccountHolder']);
                $this->setPaymentAccountHolder($paymentAccountHolder);
            }
        }
    }

    /**
     * Validate the card
     *
     * @return bool
     */
    public function validate()
    {
        $valid = [];
        //if (strlen($this->getLast4()) !== 4) {
        //    $valid[] = false;
        //}

        //TODO add code to validate the card
        return (!isset($valid[0])) ? true : false;
    }

    /**
     * Get the billing address
     *
     * @return Address
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * Set the billing address
     *
     * @param Address $billingAddress The address object
     *
     * @return void
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @return string
     */
    public function getParentTransactionId()
    {
        return $this->parentTransactionId;
    }

    /**
     * @param string $parentTransactionId
     */
    public function setParentTransactionId($parentTransactionId)
    {
        $this->parentTransactionId = $parentTransactionId;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getGateway()
    {
        return $this->gateway;
    }

    /**
     * @param string $gateway
     */
    public function setGateway($gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getGatewayStatusCode()
    {
        return $this->gatewayStatusCode;
    }

    /**
     * @param string $gatewayStatusCode
     */
    public function setGatewayStatusCode($gatewayStatusCode)
    {
        $this->gatewayStatusCode = $gatewayStatusCode;
    }

    /**
     * @return string
     */
    public function getGatewayStatusMessage()
    {
        return $this->gatewayStatusMessage;
    }

    /**
     * @param string $gatewayStatusMessage
     */
    public function setGatewayStatusMessage($gatewayStatusMessage)
    {
        $this->gatewayStatusMessage = $gatewayStatusMessage;
    }

    /**
     * @return string
     */
    public function getGatewayErrorCode()
    {
        return $this->gatewayErrorCode;
    }

    /**
     * @param string $gatewayErrorCode
     */
    public function setGatewayErrorCode($gatewayErrorCode)
    {
        $this->gatewayErrorCode = $gatewayErrorCode;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getAvsResponseCode()
    {
        return $this->avsResponseCode;
    }

    /**
     * @param string $avsResponseCode
     */
    public function setAvsResponseCode($avsResponseCode)
    {
        $this->avsResponseCode = $avsResponseCode;
    }

    /**
     * @return string
     */
    public function getCvvResponseCode()
    {
        return $this->cvvResponseCode;
    }

    /**
     * @param string $cvvResponseCode
     */
    public function setCvvResponseCode($cvvResponseCode)
    {
        $this->cvvResponseCode = $cvvResponseCode;
    }

    /**
     * @return string
     */
    public function getPaypalPendingReasonCode()
    {
        return $this->paypalPendingReasonCode;
    }

    /**
     * @param string $paypalPendingReasonCode
     */
    public function setPaypalPendingReasonCode($paypalPendingReasonCode)
    {
        $this->paypalPendingReasonCode = $paypalPendingReasonCode;
    }

    /**
     * @return string
     */
    public function getPaypalProtectionEligibility()
    {
        return $this->paypalProtectionEligibility;
    }

    /**
     * @param string $paypalProtectionEligibility
     */
    public function setPaypalProtectionEligibility($paypalProtectionEligibility)
    {
        $this->paypalProtectionEligibility = $paypalProtectionEligibility;
    }

    /**
     * @return string
     */
    public function getPaypalProtectionEligibilityType()
    {
        return $this->paypalProtectionEligibilityType;
    }

    /**
     * @param string $paypalProtectionEligibilityType
     */
    public function setPaypalProtectionEligibilityType($paypalProtectionEligibilityType)
    {
        $this->paypalProtectionEligibilityType = $paypalProtectionEligibilityType;
    }

    /**
     * @return string
     */
    public function getCheckoutPaymentDetails()
    {
        return $this->checkoutPaymentDetails;
    }

    /**
     * @param CheckoutPaymentDetails $checkoutPaymentDetails
     */
    public function setCheckoutPaymentDetails($checkoutPaymentDetails)
    {
        $this->checkoutPaymentDetails = $checkoutPaymentDetails;
    }

    /**
     * @return string
     */
    public function getPaymentAccountHolder()
    {
        return $this->paymentAccountHolder;
    }

    /**
     * @param PaymentAccountHolder $paymentAccountHolder
     */
    public function setPaymentAccountHolder($paymentAccountHolder)
    {
        $this->paymentAccountHolder = $paymentAccountHolder;
    }
}
