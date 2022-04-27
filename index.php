<?php
    //**Requiring dependent classed one by one commented because below spl_autoload_register autoloading it */
    // require_once 'src/Banklibs/Account.php';
    // require_once 'src/Banklibs/Transaction.php';
    
    //autolod dependent classes
    spl_autoload_register(function ($class) {
        require_once   str_replace('/','\\',$class) . '.php';
    });
    
    //we will be using below classes in this page
    use src\BankLibs\Account;
    use src\BankLibs\Transaction;
    
    //load dummy Data
    require_once 'src/DummyData.php';
    
    //create account and transaction objects
    $accountObj = new Account();
    $transactionObj = new Transaction();
    
    /***
     * Below are 10 function please uncomment one by one along with debug(response)
     * and see output in browser
    */


    ///***************get all accounts****************************************/
    ///*methos(params) = getAllAccounts()*/
    $response = $accountObj->getAllAccounts();
    debug($response);

    ///***************get account# 1 or 2 detail****************************************/
    ///*methos(params) = getAccountBalance(accountNumber)*/
    // $response = $accountObj->getAccountBalance(2);
    // debug($response);

    ///***************get account# 1 or 2 Transactions un-sorted****************************************/
    ///*methos(params) = getAccountTransactions(accountNumber)*/
    // $response = $accountObj->getAccountTransactions(1);
    // debug($response);

    ///***************get account# 1 or 2 Transactions order by commects ascending****************************************/
    ///*methos(params) = getAccountTransactionsSortByComments(accountNumber, sort_direction)*/
    // $response_asc  = $accountObj->getAccountTransactionsSortByComments(1,'asc');
    // debug($response_asc);

    ///***************get account# 1 or 2 Transactions order by commects decending****************************************/
    ///*methos(params) = getAccountTransactionsSortByComments(accountNumber, sort_direction)*/
    // $response_desc = $accountObj->getAccountTransactionsSortByComments(1,'desc');
    // debug($response_desc);

    ///***************get account# 1 or 2 Transactions order by date ascending****************************************/
    ///*methos(params) = getAccountTransactionsSortByDate(accountNumber, sort_direction)*/
    // $response_asc  = $accountObj->getAccountTransactionsSortByDate(1,'asc');
    // debug($response_asc);

    ///***************get account# 1 or 2 Transactions order by date decending****************************************/
    ///*methos(params) = getAccountTransactionsSortByDate(accountNumber, sort_direction)*/
    // $response_desc = $accountObj->getAccountTransactionsSortByDate(1,'desc');
    // debug($response_desc);


    ///***************Make deposit transaction****************************************/
    ///*methos(params) = deposit(accountNumber, amount,comments)*/
    // $depositResponse = $transactionObj->deposit(2,100.99,'Manual Deposit');
    // debug($depositResponse);

    ///***************Make withdraw transaction****************************************/
    ///*methos(params) = withdraw(accountNumber, amount,comments)*/
    // $withdrawResponse = $transactionObj->withdraw(2,100.99,'Manual withdraw');
    // debug($withdrawResponse);

    ///***************Make withdraw transaction with amount more than account balance****************************/
    ///*methos(params) = withdraw(accountNumber, bigger_amount,comments)*/
    // $withdraw2Response = $transactionObj->withdraw(2,9999.99,'Manual withdraw');
    // debug($withdraw2Response);

    ///***************Make withdraw transaction****************************************/
    ///*methos(params) = withdraw(accountNumber, amount,beneficiaryAccountNumber,comments)*/
    // $transferResponse = $transactionObj->transfer(2,100.99,1,'Manual transfer');
    // debug($transferResponse);



    function debug($arr){
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
    
?>





<div style="
    background:#111;
    color:#FFF;
    padding:15px;

">
    <h3>Below are some functions in /index.php, uncommment each function and its response to see result.</h3>
    <pre>
        $response = $accountObj->getAllAccounts();
        debug($response);
        
        $response = $accountObj->getAccountBalance(2);
        debug($response);
        
        $response = $accountObj->getAccountTransactions(1);
        debug($response);
        
        $response_asc  = $accountObj->getAccountTransactionsSortByComments(1,'asc');
        debug($response_asc);
        
        $response_desc = $accountObj->getAccountTransactionsSortByComments(1,'desc');
        debug($response_desc);
        
        $response_asc  = $accountObj->getAccountTransactionsSortByDate(1,'asc');
        debug($response_asc);
        
        $response_desc = $accountObj->getAccountTransactionsSortByDate(1,'desc');
        debug($response_desc);
        
        $depositResponse = $transactionObj->deposit(2,100.99,'Manual Deposit');
        debug($depositResponse);
        
        $withdrawResponse = $transactionObj->withdraw(2,100.99,'Manual withdraw');
        debug($withdrawResponse);

        $withdraw2Response = $transactionObj->withdraw(2,9999.99,'Manual withdraw');
        debug($withdraw2Response);
        
        $transferResponse = $transactionObj->transfer(2,100.99,1,'Manual transfer');
        debug($transferResponse);
    </pre>
</div>