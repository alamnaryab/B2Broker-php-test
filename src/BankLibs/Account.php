<?php
declare(strict_types=1);
namespace src\BankLibs;

class Account{

    public $respObj;
    public $DB;
    public function  __construct(){
        $this->respObj = [
            'status'=>0,
            'message'=>'Account class object created',
            'data'=>null,
        ];
        global $DB_accounts; 
        global $DB_transactions;
        $this->DB = (object)['accounts'=>$DB_accounts,'transactions'=>$DB_transactions];
    }//end __construct


    public function getAllAccounts():array{
        try{
            //simulating database select query to get all account
            $accounts= $this->DB->accounts;
            
            //unset unwanted fields starts here
            foreach($accounts as $key=>$account){
                unset($account[$key]['balance']);
            }
            //unset unwanted fields starts here
            $this->respObj = [
                'status'=>1,
                'message'=>'Get All Accounts fetched successfully',
                'data'=>$accounts,
            ];
            return $this->respObj;
        }catch(\Exception $ex){
            $this->respObj = [
                'status'=>0,
                'message'=>$ex->getMessage(),
                'data'=>$accounts,
            ];
            return $this->respObj;
        }
        

    }//end getAllAccounts()



    public function getAccountBalance($accountNumber):array{ 
        try{
            //simulating database select query to get all account
            $accounts= $this->DB->accounts;
            
            //search and get only specified account (starts here)
            $account = array_filter($accounts, function($acc) use ($accountNumber) {
                return ($acc['accountNumber'] == $accountNumber);
            });
            //search and get only specified account (starts here)
            
            $this->respObj = [
                'status'=>1,
                'message'=>'Account#'.$accountNumber.' balance fetched successfully',
                'data'=>$account,
            ];
            return $this->respObj;
        }catch(\Exception $ex){
            $this->respObj = [
                'status'=>0,
                'message'=>$ex->getMessage(),
                'data'=>$accounts,
            ];
            return $this->respObj;
        }
        
        
    }//end getAccountsBalance()

    private function getAccountTransactionsUnsorted($accountNumber){
        //simulating database select query to get all transactions
        $transactions= $this->DB->transactions;
                
        //search and get only specified account transactions (starts here)
        $account_transactions = array_filter($transactions, function($trx) use($accountNumber) {
            return ($trx['accountNumber'] == $accountNumber );
        });
        //search and get only specified account transactions (starts here)

        return $account_transactions;
    }//end getAccountTransactionsUnsorted()

    private function sortData($data,$field,$direction='asc'){
        
        usort($data, function ($item1, $item2) use($field,$direction) {
            if($direction=='asc'){
                return strcasecmp( $item1[$field],$item2[$field]);                 
            }else{
                return strcasecmp( $item2[$field],$item1[$field]); 
            }
        });
        return $data;
    }

    public function getAccountTransactions($accountNumber):array{
        try{
            $this->respObj = [
                'status'=>1,
                'message'=>'Account#'.$accountNumber.' transactions fetched successfully',
                'data'=>$this->getAccountTransactionsUnsorted($accountNumber),
            ];
            return $this->respObj;
        } catch(\Exception $ex){
            $this->respObj = [
                'status'=>0,
                'message'=>$ex->getMessage(),
                'data'=>$accounts,
            ];
            return $this->respObj;
        }
        
    }//end getAccountTransactions()


    public function getAccountTransactionsSortByComments($accountNumber,$direction='asc'):array{
        try{
            //get unsorted transactions
            $trxs = $this->getAccountTransactionsUnsorted($accountNumber);

            //sort it by comments using private function
            $sortedTrxs = $this->sortData($trxs,'comments',$direction); 
            $this->respObj = [
                'status'=>1,
                'message'=>'Account#'.$accountNumber.' transactions fetched successfully',
                'data'=>$sortedTrxs,
            ];
            return $this->respObj;
        } catch(\Exception $ex){
            $this->respObj = [
                'status'=>0,
                'message'=>$ex->getMessage(),
                'data'=>$accounts,
            ];
            return $this->respObj;
        }
    }//end getAccountTransactionsSortByComments()


    public function getAccountTransactionsSortByDate($accountNumber,$direction='asc'):array{
        try{
            //get unsorted transactions
            $trxs = $this->getAccountTransactionsUnsorted($accountNumber);

            //sort it by comments using private function
            $sortedTrxs = $this->sortData($trxs,'date',$direction);

            $this->respObj = [
                'status'=>1,
                'message'=>'Account#'.$accountNumber.' transactions fetched successfully',
                'data'=>$sortedTrxs,
            ];
            return $this->respObj;
        } catch(\Exception $ex){
            $this->respObj = [
                'status'=>0,
                'message'=>$ex->getMessage(),
                'data'=>$accounts,
            ];
            return $this->respObj;
        }
    }//end getAccountTransactionsSortByDate()


    public function isActiveAccount($accountNumber):bool{
        //simulating database select query to get all account
        $accounts= $this->DB->accounts;
        
        //search and get only specified account (starts here)
        $account = array_filter($accounts, function($acc) use($accountNumber){
            return ($acc['accountNumber'] == $accountNumber);
        });
        //search and get only specified account (starts here)
        
        return count($account)==1?true:false;
    }

    public function isNotificationSubscribed($accountNumber,$type):bool{
        //simulating database select query to get all account
        $accounts= $this->DB->accounts;
        
        //search and get only specified account (starts here)
        $subscription = array_filter($accounts, function($acc) use($accountNumber){
            return ($acc['accountNumber'] == $accountNumber);
        });
        //search and get only specified account (starts here) 
        //\debug($subscription);
        if(count($subscription)>0){
            $subscription = reset($subscription);
            if($type=='email'){
                return $subscription['subscribedForEmailNotifications'];
            }else if($type=='sms'){
                return $subscription['subscribedForSMSNotifications'];
            }
        }
        return false;
    }


}//end class Account