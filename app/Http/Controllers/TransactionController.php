<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class TransactionController extends Controller
{
    public function add($cutomer_id, $amount)
    {
        DB::insert("INSERT INTO `transactions` (`customer_id`,`amount`,`date`) VALUES (?,?,?)",[$cutomer_id,$amount,date('Y-m-d H:i:s')]);

        $id = DB::connection()->getPdo()->lastInsertId();

        $result = DB::select("SELECT id,customer_id,amount,date FROM `transactions` WHERE `id` = ?", [$id]);

        echo json_encode($result);
    }

    public function update($transaction_id, $amount)
    {
        $transaction_id = (int)$transaction_id;
        $amount = (int)$amount;
        DB::update("UPDATE `transactions` SET `amount` = ? WHERE `id` = ?",[$amount,$transaction_id]);

        $query = DB::select("SELECT id,amount,date FROM `transactions` WHERE `id` = ?", [$transaction_id]);
        echo json_encode($query);
    }

    public function delete($transaction_id)
    {
        $transaction_id = (int)$transaction_id;
        $result = DB::delete("DELETE FROM `transactions` WHERE `id` = ?", [$transaction_id]);

        echo $result ? "Success" : "Fail";
    }

    public function get($customer_id,$transaction_id)
    {
        $transaction_id = (int)$transaction_id;
        $query = DB::select("SELECT id,amount,date FROM `transactions` WHERE (`id` = ?) AND (`customer_id` = ?)", [$transaction_id,$customer_id]);

        echo json_encode($query);
    }

    public function showByFilter($customer_id,$amount,$date,$offset,$limit)
    {
        $customer_id = (int)$customer_id;
        $limit = (int)$limit;
        $offset = (int)$offset;
        $query = DB::select("SELECT id,customer_id,amount,date FROM `transactions` WHERE (`customer_id` = ?) AND (`id` >= ?)
                            LIMIT ?",[$customer_id,$offset,$limit]);

        echo json_encode($query);
    }
}
