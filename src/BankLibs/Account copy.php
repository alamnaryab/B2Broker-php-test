<?php

namespace src\BankLib;

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


    public function getAllAccounts(){
        
        //simulating database select query to get all account
        $accounts= $this->DB['accounts'];
        
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

    }//end getAllAccounts()


     

    public function getAccountBalance($accountNumber){
        
        try{
            //simulating database select query to get all account
            $accounts= $this->DB['accounts']; 
            
            //search and get only specified account (starts here)
            $account = array_filter($accounts, function($acc) use($accountNumber) {
                return ($acc['accountNumber'] == $accountNumber);
            });
            //search and get only specified account (starts here)
            if($account==null){
                throw new \Exception('No such account found.');
            }
            
            $this->respObj = [
                'status'=>1,
                'message'=>'Account#'.$accountNumber.' balance fetched successfully',
                'data'=>$account,
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
        
        
    }//end getAccountsBalance()

    private function getAccountTransactionsUnsorted($accountNumber){
        //simulating database select query to get all transactions
        $transactions= $this->DB->transactions;
                
        //search and get only specified account transactions (starts here)
        $account_transactions = array_filter($transactions, function($trx) use ($accountNumber) { 
            return ($trx['accountNumber'] == $accountNumber);
        }); 
        //search and get only specified account transactions (starts here)

        return $account_transactions;
    }//end getAccountTransactionsUnsorted()

    private function sortData($data,$field,$direction='asc'){
        $direc = $direction=='asc'?1:-1;
        usort($data, function ($item1, $item2) {
            if ($item1[$field] == $item2[$field]) return 0;
            return $item1[$field] < $item2[$field] ? $direc : $direc;
        });
    }

    public function getAccountTransactions($accountNumber){ 
        $this->respObj = [
            'status'=>1,
            'message'=>'Account#'.$accountNumber.' transactions fetched successfully',
            'data'=>$this->getAccountTransactionsUnsorted($accountNumber),
        ];
        return $this->respObj;
    }//end getAccountTransactions()


    public function getAccountTransactionsSortByComments(){
        //get unsorted transactions
        $trxs = $this->getAccountTransactionsUnsorted();

        //sort it by comments using private function
        $sortedTrxs = $this->sortData($trxs,'comments');

        $this->respObj = [
            'status'=>1,
            'message'=>'Account#'.$accountNumber.' transactions fetched successfully',
            'data'=>$sortedTrxs,
        ];
        return $this->respObj;
    }//end getAccountTransactionsSortByComments()


    public function getAccountTransactionsSortByDate(){
        //get unsorted transactions
        $trxs = $this->getAccountTransactionsUnsorted();

        //sort it by comments using private function
        $sortedTrxs = $this->sortData($trxs,'date');

        $this->respObj = [
            'status'=>1,
            'message'=>'Account#'.$accountNumber.' transactions fetched successfully',
            'data'=>$sortedTrxs,
        ];
        return $this->respObj;
    }//end getAccountTransactionsSortByDate()


    public function isActiveAccount($accountNumber){
        //simulating database select query to get all account
        $accounts= $this->DB;
        
        //search and get only specified account (starts here)
        $account = array_filter($accounts, function($acc) {
            return ($acc['accountNumber'] == $accountNumber);
        });
        //search and get only specified account (starts here)
        
        return count($account)==1?true:false;
    }


}//end class Account