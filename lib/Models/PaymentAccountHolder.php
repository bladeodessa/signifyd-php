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
 * Class PaymentAccountHolder
 * If the payment method requires an account to use, the information pertaining to that payment account should be provided.
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   bladeodessa <bladeodessa@gmail.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class PaymentAccountHolder extends Model
{
    /**
     * The date the payment account was created.
     *
     * @var string
     */
    public $accountCreatedAt;

    /**
     * The unique identifier of the payment account.
     *
     * @var string
     */
    public $accountId;

    /**
     * The full name of the account holder.
     *
     * @var string
     */
    public $accountHolderName;

    /**
     * The phone number of the account holder
     *
     * @var string
     */
    public $accountHolderPhone;

    /**
     * The email of the account holder.
     *
     * @var string
     */
    public $accountHolderEmail;

    /**
     * The date of birth of the account holder.
     *
     * @var string
     */
    public $accountHolderDob;

    /**
     * The annual income of the account holder.
     *
     * @var mixed
     */
    public $accountHolderAnnualIncome;

    /**
     * Denote whether the account holder's identity was verified by the institution or payment provider.
     *
     * @var boolean
     */
    public $accountIsVerified;

    /**
     * Denotes whether the account is live and in good standing.
     *
     * @var boolean
     */
    public $accountIsActive;

    /**
     * The total maximum amount the account can transact for.
     *
     * @var mixed
     */
    public $accountCreditLine;

    /**
     * The total available amount the account can transact for.
     *
     * @var mixed
     */
    public $accountBalance;

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
        'accountCreatedAt',
        'accountId',
        'accountHolderName',
        'accountHolderPhone',
        'accountHolderEmail',
        'accountHolderDob',
        'accountHolderAnnualIncome',
        'accountIsVerified',
        'accountIsActive',
        'accountCreditLine',
        'accountBalance',
        'billingAddress',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'accountCreatedAt'          => [],
        'accountId'                 => [],
        'accountHolderName'         => [],
        'accountHolderPhone'        => [],
        'accountHolderEmail'        => [],
        'accountHolderDob'          => [],
        'accountHolderAnnualIncome' => [],
        'accountIsVerified'         => [],
        'accountIsActive'           => [],
        'accountCreditLine'         => [],
        'accountBalance'            => [],
        'billingAddress'            => [],
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
    public function getAccountCreatedAt()
    {
        return $this->accountCreatedAt;
    }

    /**
     * @param string $accountCreatedAt
     */
    public function setAccountCreatedAt($accountCreatedAt)
    {
        $this->accountCreatedAt = $accountCreatedAt;
    }

    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param string $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * @return string
     */
    public function getAccountHolderName()
    {
        return $this->accountHolderName;
    }

    /**
     * @param string $accountHolderName
     */
    public function setAccountHolderName($accountHolderName)
    {
        $this->accountHolderName = $accountHolderName;
    }

    /**
     * @return string
     */
    public function getAccountHolderPhone()
    {
        return $this->accountHolderPhone;
    }

    /**
     * @param string $accountHolderPhone
     */
    public function setAccountHolderPhone($accountHolderPhone)
    {
        $this->accountHolderPhone = $accountHolderPhone;
    }

    /**
     * @return string
     */
    public function getAccountHolderEmail()
    {
        return $this->accountHolderEmail;
    }

    /**
     * @param string $accountHolderEmail
     */
    public function setAccountHolderEmail($accountHolderEmail)
    {
        $this->accountHolderEmail = $accountHolderEmail;
    }

    /**
     * @return string
     */
    public function getAccountHolderDob()
    {
        return $this->accountHolderDob;
    }

    /**
     * @param string $accountHolderDob
     */
    public function setAccountHolderDob($accountHolderDob)
    {
        $this->accountHolderDob = $accountHolderDob;
    }

    /**
     * @return mixed
     */
    public function getAccountHolderAnnualIncome()
    {
        return $this->accountHolderAnnualIncome;
    }

    /**
     * @param mixed $accountHolderAnnualIncome
     */
    public function setAccountHolderAnnualIncome($accountHolderAnnualIncome)
    {
        $this->accountHolderAnnualIncome = $accountHolderAnnualIncome;
    }

    /**
     * @return bool
     */
    public function isAccountIsVerified()
    {
        return $this->accountIsVerified;
    }

    /**
     * @param bool $accountIsVerified
     */
    public function setAccountIsVerified($accountIsVerified)
    {
        $this->accountIsVerified = $accountIsVerified;
    }

    /**
     * @return bool
     */
    public function isAccountIsActive()
    {
        return $this->accountIsActive;
    }

    /**
     * @param bool $accountIsActive
     */
    public function setAccountIsActive($accountIsActive)
    {
        $this->accountIsActive = $accountIsActive;
    }

    /**
     * @return mixed
     */
    public function getAccountCreditLine()
    {
        return $this->accountCreditLine;
    }

    /**
     * @param mixed $accountCreditLine
     */
    public function setAccountCreditLine($accountCreditLine)
    {
        $this->accountCreditLine = $accountCreditLine;
    }

    /**
     * @return mixed
     */
    public function getAccountBalance()
    {
        return $this->accountBalance;
    }

    /**
     * @param mixed $accountBalance
     */
    public function setAccountBalance($accountBalance)
    {
        $this->accountBalance = $accountBalance;
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
