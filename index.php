<?php
    require_once 'src/DummyData.php';
    require_once 'src/Banklibs/Account.php';
    require_once 'src/Banklibs/Transaction.php';
      
    use src\BankLib\Account;
    use src\BankLib\Transaction;

    $accountObj = new Account();
    $transactionObj = new Transaction();
    
    ///*get all accounts*/
    // $response = $accountObj->getAllAccounts();
    // debug($response);

    ///*get account# 1 or 2 detail*/
    // $response = $accountObj->getAccountBalance(2);
    // debug($response);

    ///*get account# 1 or 2 Transactions*/
    // $response = $accountObj->getAccountTransactions(1);
    // debug($response);

    ///*get account# 1 or 2 Transactions order by commects ascending*/
    // $response_asc  = $accountObj->getAccountTransactionsSortByComments(1,'asc');
    // debug($response_asc);

    ///*get account# 1 or 2 Transactions order by commects decending*/
    // $response_desc = $accountObj->getAccountTransactionsSortByComments(1,'desc');
    // debug($response_desc);

    ///*get account# 1 or 2 Transactions order by date ascending*/
    // $response_asc  = $accountObj->getAccountTransactionsSortByDate(1,'asc');
    // debug($response_asc);

    ///*get account# 1 or 2 Transactions order by date decending*/
    // $response_desc = $accountObj->getAccountTransactionsSortByDate(1,'desc');
    // debug($response_desc);


    ///*Make deposit transaction*/
    ///*methos(params) = deposit(accountNumber, amount,comments)*/
    // $depositResponse = $transactionObj->deposit(2,100.99,'Manual Deposit');
    // debug($depositResponse);

    ///*Make withdraw transaction*/
    ///*methos(params) = withdraw(accountNumber, amount,comments)*/
    // $depositResponse = $transactionObj->withdraw(2,100.99,'Manual Deposit');
    // debug($depositResponse);

    ///*Make withdraw transaction*/
    ///*methos(params) = withdraw(accountNumber, amount,beneficiaryAccountNumber,comments)*/
    $depositResponse = $transactionObj->transfer(2,100.99,1,'Manual Deposit');
    debug($depositResponse);



    function debug($arr){
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
?>