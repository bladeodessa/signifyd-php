<?php
/**
 * CaseModel for the Signifyd SDK
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
use Signifyd\Models\Card;
use Signifyd\Models\Purchase;
use Signifyd\Models\Recipient;
use Signifyd\Models\UserAccount;
use Signifyd\Models\Seller;

/**
 * Class CaseModel
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class CaseModel extends Model
{
    /**
     * Data related to purchase event represented in
     * this Case Creation request.
     *
     * @var Purchase
     */
    public $purchase;

    /**
     * Data related to person or organization receiving
     * the items purchased.
     *
     * @var array $recipients Array of Recipient objects
     */
    public $recipients;

    /**
     * Data related to the card that was used for the
     * purchase and its cardholder.
     *
     * @var array $recipients Array of Transaction objects
     */
    public $transactions;

    /**
     * If you allow customers to create an account before
     * placing an orders these data values are details from
     * that account.
     *
     * @var \Signifyd\Models\UserAccount
     */
    public $userAccount;

    /**
     * All data related to the seller of the product.
     *
     * @var array $sellers Array of Seller objects
     */
    public $sellers;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'purchase',
        'recipients',
        'transactions',
        'userAccount',
        'sellers'
    ];

    protected $objectFields = [
        'recipients',
        'transactions',
        'sellers',
    ];

    /**
     * CaseModel constructor.
     *
     * @param array $case The case data
     */
    public function __construct($case = [])
    {
        if (!empty($case) && is_array($case)) {
            foreach ($case as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                if (in_array($field, $this->objectFields)) {
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }

            if (isset($case['recipients']) && is_array($case['recipients'])) {
                foreach ($case['recipients'] as $item) {
                    $recipient = new Recipient($item);
                    $this->addRecipient($recipient);
                }
            }

            if (isset($case['transactions']) && is_array($case['transactions'])) {
                foreach ($case['transactions'] as $tItem) {
                    $transaction = new Transaction($tItem);
                    $this->addTransaction($transaction);
                }
            }

            if (isset($case['sellers']) && is_array($case['sellers'])) {
                foreach ($case['sellers'] as $sItem) {
                    $seller = new Seller($sItem);
                    $this->addSeller($seller);
                }
            }

        }
    }

    /**
     * Validate the case data
     *
     * @return array|bool
     */
    public function validate()
    {
        $valid = [];
        foreach ($this->fields as $field) {
            $obj = $this->{'get' . ucfirst($field)}();
            if (null === $obj) {
                continue;
            }
            if (!is_array($obj)) {
                $obj = [$obj];
            }

            foreach ($obj as $objItem) {
                $objValid = $objItem->validate();
                if (true !== $objValid) {
                    $valid[] = $objValid;
                }
            }

        }

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * Add recipient to the recipients array
     *
     * @param \Signifyd\Models\Recipient $recipient Recipient
     *
     * @return void
     */
    public function addRecipient($recipient)
    {
        $this->recipients[] = $recipient;
    }

    /**
     * Add recipient to the recipients array
     *
     * @param \Signifyd\Models\Transaction $transaction Transaction
     *
     * @return void
     */
    public function addTransaction($transaction)
    {
        $this->transactions[] = $transaction;
    }

    /**
     * Add seller to the sellers array
     *
     * @param \Signifyd\Models\Seller $seller Seller
     *
     * @return void
     */
    public function addSeller($seller)
    {
        $this->sellers[] = $seller;
    }

    /**
     * Get the purchase
     *
     * @return Purchase
     */
    public function getPurchase()
    {
        return $this->purchase;
    }

    /**
     * Set the purchase data
     *
     * @param Purchase $purchase The purchase data
     *
     * @return void
     */
    public function setPurchase($purchase)
    {
        $this->purchase = $purchase;
    }

    /**
     * Get a list of recipients
     *
     * @return array
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * Set a list of recipients
     *
     * @param array $recipient Array of Recipient
     *
     * @return void
     */
    public function setRecipients($recipient)
    {
        $this->recipients = $recipient;
    }

    /**
     * Get a list of transactions
     *
     * @return array
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * Set a list of transactions
     *
     * @param array $transactions Array of Transaction
     *
     * @return void
     */
    public function setTransactions($transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * Get the user account
     *
     * @return UserAccount
     */
    public function getUserAccount()
    {
        return $this->userAccount;
    }

    /**
     * Set the user account
     *
     * @param UserAccount $userAccount User Account data
     *
     * @return void
     */
    public function setUserAccount($userAccount)
    {
        $this->userAccount = $userAccount;
    }

    /**
     * Get a list of sellers
     *
     * @return array
     */
    public function getSellers()
    {
        return $this->sellers;
    }

    /**
     * Set a list of sellers
     *
     * @param array $sellers Array of Seller
     *
     * @return void
     */
    public function setSellers($sellers)
    {
        $this->sellers = $sellers;
    }
}
