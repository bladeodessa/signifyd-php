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
 * Class CheckoutPaymentDetails
 * Information about the payment method as submitted by the purchaser during checkout.
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   bladeodessa <bladeodessa@gmail.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class CheckoutPaymentDetails extends Model
{
    /**
     * The full name of the account holder as provided during checkout.
     *
     * @var string
     */
    public $holderName;

    /**
     * The first six digits of the credit card, the bank identification number, which uniquely identifies the issuer as provided during checkout.
     *
     * @var string
     */
    public $cardBin;

    /**
     * The last four digits of the credit card number as provided during checkout.
     *
     * @var string
     */
    public $cardLast4;

    /**
     * MM representation of the expiration month of the credit card as provided during checkout.
     *
     * @var string
     */
    public $cardExpiryMonth;

    /**
     * yyyy representation of the expiration year of the credit card as provided during checkout.
     *
     * @var string
     */
    public $cardExpiryYear;

    /**
     * The last 4 digits of the bank account as provided during checkout.
     *
     * @var string
     */
    public $bankAccountNumber;

    /**
     * The routing number (ABA) of the bank account that was used as provided during checkout.
     *
     * @var string
     */
    public $bankRoutingNumber;

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
        'holderName',
        'cardBin',
        'cardLast4',
        'cardExpiryMonth',
        'cardExpiryYear',
        'bankAccountNumber',
        'bankRoutingNumber',
        'billingAddress',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'holderName'        => [],
        'cardBin'           => [],
        'cardLast4'         => [],
        'cardExpiryMonth'   => [],
        'cardExpiryYear'    => [],
        'bankAccountNumber' => [],
        'bankRoutingNumber' => [],
        'billingAddress'    => [],
    ];

    protected $objectFields = [
        'billingAddress',
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

            if (isset($item['billingAddress']) && !empty($item['billingAddress'])) {
                $billingAddress = new Address($item['billingAddress']);
                $this->setBillingAddress($billingAddress);
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
     * @return string
     */
    public function getHolderName()
    {
        return $this->holderName;
    }

    /**
     * @param string $holderName
     */
    public function setHolderName($holderName)
    {
        $this->holderName = $holderName;
    }

    /**
     * @return string
     */
    public function getCardBin()
    {
        return $this->cardBin;
    }

    /**
     * @param string $cardBin
     */
    public function setCardBin($cardBin)
    {
        $this->cardBin = $cardBin;
    }

    /**
     * @return string
     */
    public function getCardLast4()
    {
        return $this->cardLast4;
    }

    /**
     * @param string $cardLast4
     */
    public function setCardLast4($cardLast4)
    {
        $this->cardLast4 = $cardLast4;
    }

    /**
     * @return string
     */
    public function getCardExpiryMonth()
    {
        return $this->cardExpiryMonth;
    }

    /**
     * @param string $cardExpiryMonth
     */
    public function setCardExpiryMonth($cardExpiryMonth)
    {
        $this->cardExpiryMonth = $cardExpiryMonth;
    }

    /**
     * @return string
     */
    public function getCardExpiryYear()
    {
        return $this->cardExpiryYear;
    }

    /**
     * @param string $cardExpiryYear
     */
    public function setCardExpiryYear($cardExpiryYear)
    {
        $this->cardExpiryYear = $cardExpiryYear;
    }

    /**
     * @return string
     */
    public function getBankAccountNumber()
    {
        return $this->bankAccountNumber;
    }

    /**
     * @param string $bankAccountNumber
     */
    public function setBankAccountNumber($bankAccountNumber)
    {
        $this->bankAccountNumber = $bankAccountNumber;
    }

    /**
     * @return string
     */
    public function getBankRoutingNumber()
    {
        return $this->bankRoutingNumber;
    }

    /**
     * @param string $bankRoutingNumber
     */
    public function setBankRoutingNumber($bankRoutingNumber)
    {
        $this->bankRoutingNumber = $bankRoutingNumber;
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
}
