<?php

//payments and budgets 
class payModel extends databaseService
{

    /**
     * adds a property to property table
     * @return bool
     */
    function insertPayment($to, $from, $pay, $total, $class, $memo)
    {
        $out = $total - $pay;//get the outstanding payment
        if ($out<0){
            return false;
        }
        if ($this->Query("INSERT INTO payment 
        (payTo, payFrom, total, outstanding, class, memo)
        VALUES(?,?,?,?,?,?)", [$to,$from,$pay, $out, $class, $memo])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * removes a property from the database
     * @param $userId : User id for the user to be deleted
     */
    function updatePayment($pid,$to, $from, $pay, $total, $class, $memo){
        if ($this->Query("UPDATE payment SET
        (payTo=?, payFrom=?, total=?, outstanding=?, class=?, memo=?) WHERE
        pid = ?", [$to,$from,$pay, $out, $class, $memo,$userId])){
            return true;
        } else {
            return false;
        }
    }

    /**
     * removes a property from the database
     * @param $userId : User id for the user to be deleted
     */
    function deleteProperty($pid){
        return $this->Query("DELETE FROM payment WHERE pid = ?", [$pid]);
    }


    //flat payments (just the one table)
    function getAllPayments($eid){
        if ($this->Query("SELECT DISTINCT *
        FROM 
        payment
        WHERE
        payTo = ? OR payFrom = ?", [$eid, $eid])) {
            return $this->fetchAll();
        }
    }

    function getInPayments($eid){
        if ($this->Query("SELECT DISTINCT *
        FROM 
        payment
        WHERE
        payTo = ?", [$eid])) {
            return $this->fetchAll();
        }
    }

    function getOutPayments($eid){
        if ($this->Query("SELECT DISTINCT *
        FROM 
        payment
        WHERE
        payFrom = ?", [$eid])) {
            return $this->fetchAll();
        }
    }
    //accounts (A listing used for the reports and whatnot by making it ;look nicer)
    //flat payments (just the one table)
    function getAccountsTotal($eid){
        if ($this->Query("SELECT DISTINCT 
        COUNT(*) AS totalPayments,
        SUM(p2.total) AS totalOwed,
        SUM(p2.outstanding) AS totalOwedOutstanding,
        SUM(p3.total) AS totalOwe,
        SUM(p3.outstanding) AS totalOweOutstanding
        FROM 
        payment p1,
        payment p2,
        payment p3
        WHERE
        (p1.payTo = ? OR p1.payFrom = ?) AND p2.payTo = ? AND p3.payFrom = ?", [$eid, $eid,$eid, $eid])) {
            return $this->fetchAll();
        } else {
            return null;
        }
    }

    function getInAccounts($eid){
        if ($this->Query("SELECT DISTINCT
        p.pid AS   pid, 
        p.payTo AS payeeAccount,
        p.payFrom AS payorAccount,
        e1.userId AS payeeName,
        e2.userId AS payorName,
        p.class AS paymentType,
        p.outstanding AS outstanding,
        p.total AS total,
        p.memo as memo
        FROM 
        payment p,
        entity e1,
        entity e2
        WHERE
        p.class != 'BUDGET' 
        AND
        p.payTo = e1.eid 
        AND 
        p.payFrom = e2.eid
        AND
        e1.eid = ?
        ORDER BY p.posted", [$eid])) {
            return $this->fetchAll();
        } else {
            return null;
        }
    }

    function getOutAccounts($eid){
        if ($this->Query("SELECT DISTINCT
        p.pid AS   pid,
        p.posted AS posted, 
        p.payTo AS payeeAccount,
        p.payFrom AS payorAccount,
        e1.userId AS payeeName,
        e2.userId AS payorName,
        p.class AS paymentType,
        p.outstanding AS outstanding,
        p.total AS total,
        p.memo as memo
        FROM 
        payment p,
        entity e1,
        entity e2
        WHERE
        p.class != 'BUDGET' 
        AND
        p.payTo = e1.eid 
        AND 
        p.payFrom = e2.eid
        AND
        e2.eid = ?
        ORDER BY p.posted", [$eid])) {
            return $this->fetchAll();
        }else {
            return null;
        }
    }
 

}
