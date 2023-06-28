<?php
class trade_model extends CI_Model
{
    public function can_login($username, $password)
    {
        $query = $this->db->get_where('users', array('username' => $username));
    
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $stored_password = $row->password;
    
            if (md5($password) === $stored_password) {
                $account_status = $this->get_account_status($row->id);
    
                if ($account_status == 'on' && $row->user_role == 'user') {
                    $this->session->set_userdata('id', $row->id);
                    return 'Success';
                } elseif ($row->user_role != 'user') {
                    return 'Access Denied: Only users can login';
                } else {
                    return 'Account is inactive';
                }
            } else {
                return 'Wrong Password';
            }
        } else {
            return 'Wrong User Name';
        }
    }
    public function getMaxLotSize($user_id)
    {
        $query = $this->db->get_where('equity_features', array('user_id' => $user_id));

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->max_lot_size_equity;
        }
        return 0;
    }

    private function get_account_status($user_id)
    {
        $query = $this->db->get_where('config', array('user_id' => $user_id));

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->account_status;
        } else {
            return 'inactive';
        }
    }

    public function generate_transaction_id()
    {
        $transaction_id = uniqid();
        // print_r($transaction_id);die;
        return $transaction_id;
    }

    public function add_fund($data)
    {
        $user_id = $this->session->userdata('id');
        $data['user_id'] = $user_id;
        $data['transaction_date'] = date('Y-m-d H:i:s');

        $query = $this->db->get_where('funds', array('user_id' => $user_id));

        if ($query->num_rows() > 0) {
            $existing_amount = $query->row()->amount;
            $new_amount = $existing_amount + $data['amount'];

            $this->db->where('user_id', $user_id)
                ->update('funds', ['amount' => $new_amount,
                 'transaction_date' => $data['transaction_date']]);
        } else {
            $this->db->insert('funds', $data);
        }

        // Insert transaction history
        $transaction_data = array(
            'user_id' => $user_id,
            'amount' => $data['amount'],
            'type' => 'add',
            'transaction_date' => $data['transaction_date'],
            'transaction_id' => $data['transaction_id']
        );
        $this->db->insert('transaction_history', $transaction_data);
    }

    public function add_fund_from_admin($data)
    {
        $user_id = $data['user_id'];
        // print_r($user_id);die;
        $data['user_id'] = $user_id;

        date_default_timezone_set('Asia/Kolkata');
        $data['transaction_date'] = date('Y-m-d H:i:s');

        $this->db->where('user_id', $user_id);
        $query = $this->db->get('funds');

        if ($query->num_rows() > 0) {
            $existing_amount = $query->row()->amount;
            $new_amount = $existing_amount + $data['amount'];

            $this->db->where('user_id', $user_id);
            $this->db->update('funds', ['amount' => $new_amount, 'transaction_date' => $data['transaction_date']]);

            // Insert transaction history
            $transaction_data = array(
                'user_id' => $user_id,
                'amount' => $data['amount'],
                'type' => 'add',
                'transaction_date' => $data['transaction_date']
            );
            $this->db->insert('transaction_history', $transaction_data);
        } else {
            $this->db->insert('funds', $data);

            // Insert transaction history
            $transaction_data = array(
                'user_id' => $user_id,
                'amount' => $data['amount'],
                'type' => 'add',
                'transaction_date' => $data['transaction_date']
            );
            $this->db->insert('transaction_history', $transaction_data);
        }
    }


    public function getTotalAmount($user_id)
    {
        $this->db->select('amount');
        $this->db->from('funds');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->amount;
        } else {
            return 0;
        }
    }

    public function withdrawAmount($user_id, $withdraw_amount)
    {
        // print_r($user_id);die;
        $currentBalance = $this->getTotalAmount($user_id);
        if ($currentBalance >= $withdraw_amount) {
            $newBalance = $currentBalance - $withdraw_amount;

            $this->db->set('amount', $newBalance);
            $this->db->where('user_id', $user_id);
            $this->db->update('funds');

            $withdrawal_data = array(
                'user_id' => $user_id,
                'withdrawal_amount' => $withdraw_amount,
                'transaction_date' => date('Y-m-d')
            );
            $this->db->insert('withdrawal_funds', $withdrawal_data);
            $withdrawal_his = array(
                'user_id' => $user_id,
                'amount' => $withdraw_amount,
                'type' => 'withdraw',
                'transaction_date' => date('Y-m-d')
            );
            // print_r($withdrawal_his);die;
            $this->db->insert('transaction_history', $withdrawal_his);
            return true;
        } else {
            return false;
        }
    }

    function checkCurrentPassword($currentPassword)
    {
        $userid = $this->session->userdata('id');
        $hashedPassword = md5($currentPassword); // Apply MD5 hashing to the current password
    
        $query = $this->db->query("SELECT * from users WHERE id='$userid' AND password='$hashedPassword'");
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function updatePassword($password)
    {
        $userid = $this->session->userdata('id');
        $query = $this->db->query("update  users set password='$password' WHERE id='$userid' ");
    }

    public function insertBuyData($data)
    {
        $data['buy_ip'] = $_SERVER['REMOTE_ADDR'];
        $data['bought_at'] = date('Y-m-d H:i:s');
        $this->db->insert('buy_sell_trades', $data);
    }

    public function insertSellData($data)
    {
        $data['sell_ip'] = $_SERVER['REMOTE_ADDR'];
        $data['sell_at'] = date('Y-m-d H:i:s');
        // print_r($data['sell_ip']);die;
        $this->db->insert('buy_sell_trades', $data);
    }

    public function getScripNames($trades)
    {
        $scripIds = array_column($trades, 'scrip_id');

        $this->db->select('scrip_id, scrip_name, bid, last');
        $this->db->where_in('scrip_id', $scripIds);
        $query = $this->db->get('trading_table');
        $scripNames = array();

        foreach ($query->result_array() as $row) {
            $scripNames[] = array(
                'scrip_id' => $row['scrip_id'],
                'scrip_name' => $row['scrip_name'],
                'bid' => $row['bid'],
                'last' => $row['last'],
            );
        }

        return $scripNames;
    }
    public function get_transaction_history($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('transaction_history');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); // Empty array if no transaction history found
        }
    }

    public function getTotalMarginUsed() {
        $query = $this->db->get('buy_sell_trades')->result_array();
        $totalMarginUsed = array(); // Array to store total margin used for each day
    
        foreach ($query as $trade) {
            $lotSize = $trade['lot'];
            $buySell = $trade['buy_rate'];
            $tradeDate = date('Y-m-d', strtotime($trade['created_at'])); // Assuming the trade date is stored in the 'bought_at' column
            $marginRate = 0.5; 
    
            $marginUsed = ($buySell == 'buy') ? ($lotSize * $trade['buy_price'] * $marginRate) : ($lotSize * $trade['sell_rate'] * $marginRate);
    
            if (isset($totalMarginUsed[$tradeDate])) {
                $totalMarginUsed[$tradeDate] += $marginUsed;
            } else {
                $totalMarginUsed[$tradeDate] = $marginUsed;
            }
        }
    
        return $totalMarginUsed;
    }
          
}
