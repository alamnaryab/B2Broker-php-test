<?php
    $DB_accounts = [
        [
            "accountNumber"=>1,
            "accountHolderName"=>"Alam",
            "balance"=>999.90,
            "subscribedForEmailNotifications"=>true,
            "subscribedForSMSNotifications"=>true,
        ],
        [
            "accountNumber"=>2,
            "accountHolderName"=>"Deepak",
            "balance"=>4000.26,
            "subscribedForEmailNotifications"=>true,
            "subscribedForSMSNotifications"=>false,
        ],
    ];

    $DB_transactions = [
        [
            "transactionType" =>"deposit",
            "accountNumber" =>1,
            "amount"=>5000.00,
            "date"=>date("Y-m-d H:i:s", strtotime("-10 days")),
            "comments" => "First salary deposited from xyz company"
        ],
        [
            "transactionType" =>"withdraw",
            "accountNumber" =>1,
            "amount"=>3000.00,
            "date"=> date("Y-m-d H:i:s", strtotime("-7 days")),
            "comments" => "widthdrawal at ATM-2332322323"
        ],
        [
            "transactionType" =>"transfer",
            "accountNumber" =>1,
            "beneficiaryAccountNumber"=>2,
            "amount"=>2000.10, 
            "date"=>date("Y-m-d H:i:s", strtotime("-4 days")),
            "comments" => "Memo: friend needed"
        ],
        [
            "transactionType" =>"deposit",
            "accountNumber" =>2,
            "amount"=>10000.26,
            "date"=>date("Y-m-d H:i:s", strtotime("-9 days")),
            "comments" => "May-2022 salary deposited from MNO company"
        ],
        [
            "transactionType" =>"withdraw",
            "accountNumber" =>2,
            "amount"=>1000.00,
            "date"=> date("Y-m-d H:i:s", strtotime("-8 days")),
            "comments" => "widthdrawal with cheque#12345678910"
        ],
        [
            "transactionType" =>"withdraw",
            "accountNumber" =>2,
            "amount"=>2000.00,
            "date"=> date("Y-m-d H:i:s", strtotime("-6 days")),
            "comments" => "widthdrawal at ATM-2332322323"
        ],
        [
            "transactionType" =>"transfer",
            "accountNumber" =>2,
            "beneficiaryAccountNumber"=>1,
            "amount"=>3000.00, 
            "date"=>date("Y-m-d H:i:s", strtotime("-2 days")),
            "comments" => "Memo: Brother account"
        ],
        
    ];
 
    
?>
