<?php
declare(strict_types=1);
namespace src\Vendor\Notifications;
use \src\BankLibs\Account;

class Notification{

    public $notifications;
    public $accountObj;
    public function __construct(){
        $this->accountObj = new Account();
        $this->nottifications=[];
    }//end __construct()

    public function send($trx):array{
        //\debug($trx);
        if($trx['transactionType']=='transfer'){
            //send notifications to sender
            $senderStr = "Your account#{$trx['accountNumber']} debited with {$trx['amount']} AED at {$trx['date']} transfered to account#{$trx['benificiaryAccountNumber']}";
            if($this->accountObj->isNotificationSubscribed($trx['accountNumber'],'email')){
                //send email($senderStr);
                $this->nottifications[]['email_to_accountholder']=$senderStr;
            }
            if($this->accountObj->isNotificationSubscribed($trx['accountNumber'],'sms')){
                //send SMS($senderStr);
                $this->nottifications[]['sms_to_accountholder']=$senderStr;
            }

            //send notifications to receiver/beneficiary
            $receiverStr = "Your account#{$trx['benificiaryAccountNumber']} credited with {$trx['amount']} AED at {$trx['date']} transfered from account#{$trx['accountNumber']}";
            if($this->accountObj->isNotificationSubscribed($trx['benificiaryAccountNumber'],'email')){
                //send email($receiverStr);
                $this->nottifications[]['email_to_benificiary']=$receiverStr;
            }
            if($this->accountObj->isNotificationSubscribed($trx['benificiaryAccountNumber'],'sms')){
                //send SMS($receiverStr);
                $this->nottifications[]['sms_to_benificiary']=$receiverStr;
            }
        }else if($trx['transactionType']=='deposit' || $trx['transactionType']=='withdraw'){ 
            $str = "Your account#{$trx['accountNumber']} deposited with {$trx['amount']} AED at {$trx['date']}";
            if($this->accountObj->isNotificationSubscribed($trx['accountNumber'],'email')){
                //send email($str);
                $this->nottifications[]['email_to_accountholder']=$str;
            }
            if($this->accountObj->isNotificationSubscribed($trx['accountNumber'],'sms')){
                //send SMS($str);
                $this->nottifications[]['sms_to_accountholder']=$str;
            }
        }
        return $this->nottifications;
    }
 
}
?>