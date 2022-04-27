<?php
    require_once 'src/DummyData.php';
    require_once 'src/Banklibs/Account.php';
    require_once 'src/Banklibs/Transaction.php';

    use src\BankLib\Account;
    use src\BankLib\Transaction;

    $accountObj = new Account();
    $transactionObj = new Transaction();
    
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
    // $withdrawResponse = $transactionObj->withdraw(2,100.99,'Manual Deposit');
    // debug($withdrawResponse);

    ///***************Make withdraw transaction****************************************/
    ///*methos(params) = withdraw(accountNumber, amount,beneficiaryAccountNumber,comments)*/
    // $transferResponse = $transactionObj->transfer(2,100.99,1,'Manual Deposit');
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
    <h3>Below are 10 function in /index.php, uncommment each function and its response to see result.</h3>
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
        
        $withdrawResponse = $transactionObj->withdraw(2,100.99,'Manual Deposit');
        debug($withdrawResponse);
        
        $transferResponse = $transactionObj->transfer(2,100.99,1,'Manual Deposit');
        debug($transferResponse);
    </pre>
</div>