<?php
declare(strict_types=1);
namespace src\BankLibs;

require_once 'src/Vendor/Notifications/Notification.php';
use src\Vendor\Notifications\Notification as NotificationAlias;  

class Transaction{

    public $respObj;
    public $accountObj;
    public $notificationObj;
    public function  __construct(){
        
        $this->respObj = [
            'status'=>0,
            'message'=>'Transcation class object created',
            'data'=>null,
        ];

        $this->accountObj = new Account();

        $this->notificationObj = new NotificationAlias();

    }//end  __construct()



    public function deposit($accountNumber, $amount,$comments=''):array{
        try{
            //validate if accountnumber is an active account by calling isActiveAccount() from Account Calss
            
            $isActiveAccount = $this->accountObj->isActiveAccount($accountNumber);
            if(!$isActiveAccount){
                throw new \Exception($accountNumber.' is not an active account.');
            }

            //if it is active account then make transaction
            $trxData  = [
                'transactionType' =>'deposit',
                'accountNumber' =>$accountNumber,
                'amount'=>$amount,
                'date'=>date('Y-m-d H:i:s'),
                'comments' => $comments
            ];
            //insert transaction into database table
            //$db->save( $trxData );

            //send notification to account holder if he have sucscribed for email and/or sms notifications
            $notificationsResp = $this->notificationObj->send($trxData);

            
            $this->respObj = [
                'status'=>1,
                'message'=>'Deposit Transcation made successfully. ',
                'notificationsLog'=>$notificationsResp,
                'data'=>$trxData,
            ];
            return $this->respObj;

        }catch(\Exception $ex){
            $this->respObj = [
                'status'=>-1,
                'message'=>$ex->getMessage(),
                'data'=>null,
            ];
            return $this->respObj;
        }
        
    }//end deposit()



    public function withdraw($accountNumber, $amount,$comments):array{
        try{
            //validate if accountnumber is an active account by calling isActiveAccount() from Account Calss
            
            $isActiveAccount = $this->accountObj->isActiveAccount($accountNumber);
            if(!$isActiveAccount){
                throw new Exception($accountNumber.' is not an active account.');
            }

            //validate if account has equalto or more than provided amount
            $accountBalanceAmount = $this->accountObj->getAccountBalance($accountNumber);
            if(count($accountBalanceAmount['data'])>0){
                $accountBalanceAmount = reset($accountBalanceAmount['data']);
                if($accountBalanceAmount['balance'] < $amount){
                    throw new \Exception("Account# {$accountNumber} has not enough balance to withdraw AED {$amount}.");
                }
            }
            
            
            //if it is active account and has enough balance then make transaction
            $trxData  = [
                'transactionType' =>'withdraw',
                'accountNumber' =>$accountNumber,
                'amount'=>$amount,
                'date'=>date('Y-m-d H:i:s'),
                'comments' => $comments
            ];

            //insert transaction into database table
            //$db->save( $trxData );

            //send notification to account holder if he have sucscribed for email and/or sms notifications
            $notificationsResp = $this->notificationObj->send($trxData);

            
            $this->respObj = [
                'status'=>1,
                'message'=>'Widthdraw Transcation made successfully. ',
                'notificationsLog'=>$notificationsResp,
                'data'=>$trxData,
            ]; 
            return $this->respObj;

        }catch(\Exception $ex){
            $this->respObj = [
                'status'=>-1,
                'message'=>$ex->getMessage(),
                'data'=>null,
            ];
            return $this->respObj;
        }
    }//end withdraw()

    public function transfer($accountNumber, $amount,$beneficiaryAccountNumber,$comments):array{

        try{
            //validate if account and beneficiaryAccountNumber is same
            if($accountNumber == $beneficiaryAccountNumber){
                throw new \Exception('Transfer transaction can not be made to same account.');
            }

            //validate if accountnumber is an active account by calling isActiveAccount() from Account Calss            
            $isActiveAccount = $this->accountObj->isActiveAccount($accountNumber);
            if(!$isActiveAccount){
                throw new \Exception($accountNumber.' is not an active account.');
            }

            //validate if beneficiary accountnumber is an active account by calling isActiveAccount() from Account Calss            
            $isBeneficiaryAccountActive = $this->accountObj->isActiveAccount($beneficiaryAccountNumber);
            if(!$isBeneficiaryAccountActive){
                throw new \Exception('Beneficiary account#'.$beneficiaryAccountNumber.' is not an active account.');
            }

            //validate if account has equalto or more than provided amount
            $accountBalanceAmount = $this->accountObj->getAccountBalance($accountNumber);
            if(count($accountBalanceAmount['data'])>0){
                $accountBalanceAmount = reset($accountBalanceAmount['data']);
                if($accountBalanceAmount['balance'] < $amount){
                    throw new \Exception("Account# {$accountNumber} has not enough balance to transfer.");
                }
            }

            //if all above validations are ok then make transaction obj to be passed to database
            $trxData  = [
                'transactionType' =>'transfer',
                'accountNumber' =>$accountNumber,
                'benificiaryAccountNumber'=>$beneficiaryAccountNumber,
                'amount'=>$amount,
                'date'=>date('Y-m-d H:i:s'),
                'comments' => $comments
            ];

            //insert transaction into database table
            //$db->save( $trxData );

            //send notification to account holders if they have sucscribed for email and/or sms notifications
            $notificationsResp = $this->notificationObj->send($trxData);
            
            $this->respObj = [
                'status'=>1,
                'message'=>'Transfer Transcation made successfully. ',
                'notificationsLog'=>$notificationsResp,
                'data'=>$trxData,
            ];  
            return $this->respObj;

        }catch(\Exception $ex){
            $this->respObj = [
                'status'=>-1,
                'message'=>$ex->getMessage(),
                'data'=>null,
            ];
            return $this->respObj;
        }

    }//end transfer()

}//end Calss Transaction

?>