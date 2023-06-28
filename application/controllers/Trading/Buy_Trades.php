<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buy_Trades extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
        if (!$this->_is_logged_in()) {
            redirect("trading");
        }
        $this->load->model('trade_model');
        $this->load->model('login_model');
    }

    public function buy()
    {
        $scrip_id = $this->input->post('scrip_id');
        $tradeType = $this->input->post('typeTrade');
        $userid = $this->session->userdata('id');
        $lotValue = $this->input->post('lot');
        $scrip_name = $this->input->post('scrip_name');
        $bidPrice = $this->input->post('order_ask_price');
        $lot_size = $this->input->post('lot_size');
        date_default_timezone_set('Asia/Kolkata');
        $currentTime = date('H:i');
        $closingTimeNSE = '18:30'; // 3:30 PM for NSE
        $closingTimeMCX = '24:55'; // 11:55 PM for MCX

        if ((($tradeType == 'NSE') && ($currentTime > $closingTimeNSE)) || (($tradeType == 'MCX') && ($currentTime > $closingTimeMCX))) {
            $response = array(
                'success' => false,
                'error' => 'The market is not open for trading or the order was placed outside of trading hours.'
            );
            echo json_encode($response);
            return;
        }
        $fudstableValue = $this->getFudstableValue();
        $totalPrice = $lotValue * $bidPrice * $lot_size;
        // echo'<pre>';print_r($totalPrice);die;
        $this->db->where('user_id', $userid);
        $equityFeatures = $this->db->get('equity_features')->row();
        $maxLotSize = $equityFeatures->max_lot_size_equity;
        $minLotSize = $equityFeatures->min_lot_size_equity;
        
        $this->db->where('user_id', $userid);
        $mcxFeatures = $this->db->get('mcx_features')->row();
        $maxLotSize_mcx = $mcxFeatures->maximum_lot_per_single;
        $minLotSize_mcx = $mcxFeatures->minimum_lot;
        
        $this->db->where('user_id', $userid);
        $optionsFeatures = $this->db->get('option_config')->row();
 
        $maxLotSize_options = $optionsFeatures->max_lot_size_equity_options;
        $minLotSize_options = $optionsFeatures->min_lot_size_equity_options;
   
        if ($tradeType == 'NSE') {
            $maxLotSize = $equityFeatures->max_lot_size_equity;
            $minLotSize = $equityFeatures->min_lot_size_equity;
        } elseif ($tradeType == 'MCX') {
            $maxLotSize = $mcxFeatures->maximum_lot_per_single;
            $minLotSize = $mcxFeatures->minimum_lot;
        }
        elseif ($tradeType == 'OPTIONS') {
            $maxLotSize = $optionsFeatures->max_lot_size_equity_options;
            $minLotSize = $optionsFeatures->min_lot_size_equity_options;
        } else {
            $maxLotSize = 0;
            $minLotSize = 0;
        }
        
        if ($lotValue > $maxLotSize) {
            $response = array(
                'success' => false,
                'error' => 'Exceeded maximum lot size. Maximum allowed lot size: ' . $maxLotSize
            );
        } elseif ($lotValue < $minLotSize) {
            $response = array(
                'success' => false,
                'error' => 'Below minimum lot size. Minimum allowed lot size: ' . $minLotSize
            );
        }  elseif ($totalPrice <= $fudstableValue) {
            $newFudstableValue = $fudstableValue - $totalPrice;

            $this->db->where('user_id', $userid);
            $this->db->update('funds', array('amount' => $newFudstableValue));
            date_default_timezone_set('Asia/Kolkata');
            $buy_data = array(
                'user_id' => $userid,
                'scrip_id' => $scrip_id,
                'lot' => $lotValue,
                'buy_rate' => $bidPrice,
                'order_ask_price' => $bidPrice,
                'symbol' => $scrip_name,
                'action' => 'buy',
                'lot_size' => $lot_size,
                'status' => 'active',
                'market_type' => 'market',
                'bought_at' => date('Y-m-d H:i:s')
            );
            // print_r($buy_data);die;
            $this->trade_model->insertBuyData($buy_data);

            $response = array(
                'success' => true,
                'message' => 'Bought '.$lotValue.'.0000'.' lot of '.$scrip_name.' at '.$bidPrice.' rupees.'
            );
        } else {
            $response = array(
                'success' => false,
                'error' => 'Insufficient fudstable balance'
            );
        }
        echo json_encode($response);
    }


    public function getFudstableValue()
    {
        $userid = $this->session->userdata('id');
        $this->db->select('amount');
        $this->db->from('funds');
        $this->db->where('user_id', $userid);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->amount;
        } else {
            return 0;
        }
    }
    public function sell()
    {
        $scrip_id = $this->input->post('scrip_id');
        $userid = $this->session->userdata('id');
        $tradeType = $this->input->post('typeTrade');
        $lotValue = $this->input->post('lot');
        $scrip_name = $this->input->post('scrip_name');
        $bidPrice = $this->input->post('order_ask_price');
        $lot_size = $this->input->post('lot_size');
        
        $fudstableValue = $this->getFudstableValue();
        date_default_timezone_set('Asia/Kolkata');
        $currentTime = date('H:i');
        $closingTimeNSE = '18:30'; // 3:30 PM for NSE
        $closingTimeMCX = '24:55'; // 11:55 PM for MCX

        if ((($tradeType == 'NSE') && ($currentTime > $closingTimeNSE)) || (($tradeType == 'MCX') && ($currentTime > $closingTimeMCX))) {
            $response = array(
                'success' => false,
                'error' => 'The market is not open for trading or the order was placed outside of trading hours.'
            );
            echo json_encode($response);
            return;
        }
        $isSold = $this->checkIfSold($scrip_id);
        $isBought = $this->checkIfBought($scrip_id);
        // print_r($isSold);
    //    print_r($isBought);die;
        if ($isSold[0]['sell_count'] >= 0 && $isBought[0]['buy_count'] > 0) {
            $remainingLots = $isBought[0]['buy_count'] - $isSold[0]['sell_count'];
            // print_r($remainingLots);die;
            $lots = $isBought[0]['buy_lot_count'] - $isSold[0]['sell_lot_count'];
            if ($remainingLots > 0 || $lots > 0) {
                $totalPrice = $lotValue * $bidPrice * $lot_size;
                // print_r($totalPrice);die;
                    $newFudstableValue = $fudstableValue + $totalPrice;
                    // print_r($newFudstableValue);die;
                    $this->db->where('user_id', $userid);
                    $this->db->update('funds', array('amount' => $newFudstableValue));

                    $sell_data = array(
                        'user_id' => $userid,
                        'scrip_id' => $scrip_id,
                        'lot' => $lotValue,
                        'sell_rate' => $bidPrice,
                        'action' => 'sell',
                        'symbol' => $scrip_name,
                        'lot_size' => $lot_size,
                        'status' => 'pending',
                        'market_type' => 'market',
                        'sell_at' => date('Y-m-d H:i:s')
                    );
                    // print_r($sell_data);die;
                    $this->trade_model->insertSellData($sell_data);

                    $response = array(
                        'success' => true,
                        'message' => 'Sold '.$lotValue.'.0000'.' lot of '.$scrip_name.' at '.$bidPrice.' rupees.'
                    );
                // } else {
                //     $response = array(
                //         'success' => false,
                //         'error' => 'Insufficient funds to sell.'
                //     );
                // }
            } else {
                $response = array(
                    'success' => false,
                    'error' => 'Trade has not been bought. Sell action not allowed.'
                );
            }
        } else {
            $response = array(
                'success' => false,
                'error' => 'Please buy a trade.'
            );
        }

        echo json_encode($response);
    }
    public function place_buy_order()
    {
        $userid = $this->session->userdata('id');
        $scrip_id = $this->input->post('scrip_id');
        $query = $this->db->select('last, lower_circuit, upper_circuit, scrip_name')->where('scrip_id', $scrip_id)->get('trading_table')->row_array();
        $bidPriceFromDatabase = $query['last'];
        $lowerCircuit = $query['lower_circuit'];
        $UpperCircuit = $query['upper_circuit'];
        $lot_size = $this->input->post('lot_size');
        $scrip_name = $query['scrip_name'];
        $order_ask_Price = $this->input->post('price');
        $lotvalue = $this->input->post('lot');
        $tradeType = $this->input->post('typeTrade');
        
        if (!is_numeric($order_ask_Price) || $order_ask_Price <= 0) {
            $response = array(
                'success' => false,
                'message' => 'Invalid price. Please enter a valid price.',
            );
            echo json_encode($response);
            return;
        }
        
        if ($order_ask_Price <= $lowerCircuit) {
            $response = array(
                'success' => false,
                'error' => 'Order price must be greater than the lower circuit of ' . $lowerCircuit,
            );
            echo json_encode($response);
            return;
        }
        
        if ($order_ask_Price >= $UpperCircuit) {
            $response = array(
                'success' => false,
                'error' => 'Order price must be less than the upper circuit of ' . $UpperCircuit,
            );
            echo json_encode($response);
            return;
        }
    
        if ($order_ask_Price != $bidPriceFromDatabase) {
            $status = 'pending';
        } else {
            $status = 'active';
        }
        date_default_timezone_set('Asia/Kolkata');
        $buy_data = array(
            'user_id' => $userid,
            'scrip_id' => $scrip_id,
            'lot' => $lotvalue,
            'order_ask_price' => $order_ask_Price,
            'buy_rate' => $order_ask_Price,
            'action' => 'buy',
            'lot_size' => $lot_size,
            'status' => $status,
            'buy_ip' => $_SERVER['REMOTE_ADDR'],
            'market_type' => 'order',
            'bought_at' => date('Y-m-d H:i:s')
        );
    
        $this->trade_model->insertBuyData($buy_data);
    
        if ($status == 'active') {
            $message = 'Buy Order of ' . $lotvalue . ' Lot of ' . $scrip_name . ' executed at Rs. ' . $order_ask_Price . '.';
        } else {
            $message = 'Buy Order of ' . $lotvalue . ' Lot of ' . $scrip_name . ' scheduled to execute above Rs. ' . $order_ask_Price . '.';
        }
    
        $response = array(
            'success' => true,
            'message' => $message,
        );
        echo json_encode($response);
    }
    
    public function place_sell_order()
    {
        $userid = $this->session->userdata('id');
        $scrip_id = $this->input->post('scrip_id');
        $query = $this->db->select('last, lower_circuit, upper_circuit, scrip_name')->where('scrip_id', $scrip_id)->get('trading_table')->row_array();
        $bidPriceFromDatabase = $query['last'];
        $lowerCircuit = $query['lower_circuit'];
        $UpperCircuit = $query['upper_circuit'];
        $scrip_name = $query['scrip_name'];
        $order_ask_Price = $this->input->post('price');
        $lotvalue = $this->input->post('lot');
        $tradeType = $this->input->post('typeTrade');
        if (!is_numeric($order_ask_Price) || $order_ask_Price <= 0) {
            $response = array(
                'success' => false,
                'message' => 'Invalid price. Please enter a valid price.',
            );
            echo json_encode($response);
            return;
        }
        if ($order_ask_Price <= $lowerCircuit) {
            $response = array(
                'success' => false,
                'error' => 'Order price must be greater than lower circuit of ' . $lowerCircuit,
            );
            echo json_encode($response);
            return;
        }
        if ($order_ask_Price >= $UpperCircuit) {
            $response = array(
                'success' => false,
                'error' => 'Order price must be less than upper circuit of ' . $UpperCircuit,
            );
            echo json_encode($response);
            return;
        }

        if ($order_ask_Price != $bidPriceFromDatabase) {

            $buy_data = array(
                'user_id' => $userid,
                'scrip_id' => $scrip_id,
                'lot' => $lotvalue,
                'order_ask_price' => $order_ask_Price,
                'action' => 'sell',
                'status' => 'pending',
                'sell_ip' => $_SERVER['REMOTE_ADDR'],
                'market_type' => 'order'           
            );
            $this->trade_model->insertBuyData($buy_data);
            $response = array(
                'success' => true,
                'message' => 'Buy Order of '.$lotvalue.' Lot of '.$scrip_name.' scheduled to execute Above Rs. '.$order_ask_Price.'.'
            );
            echo json_encode($response);
            return;
        }

        $response = array(
            'success' => true,
            'message' => 'Order placed successfully!',
        );
        echo json_encode($response);
    }

    private function checkIfBought($scrip_id)
    {
        $userId = $this->session->userdata('id');
        $this->db->select('count(id) as buy_count, sum(lot) as buy_lot_count');
        $this->db->where('user_id', $userId);
        $this->db->where('scrip_id', $scrip_id);
        $this->db->where('action', 'buy');
        $this->db->where('status !=', 'closed');
        $this->db->where('status !=', 'pending');
        $result = $this->db->get('buy_sell_trades')->result_array();
        // print_r($result);die;
        return ($result);
    }

    private function checkIfSold($scrip_id)
    {
        $userId = $this->session->userdata('id');
        $this->db->select('count(id) as sell_count, sum(lot) as sell_lot_count');
        $this->db->where('user_id', $userId);
        $this->db->where('scrip_id', $scrip_id);
        $this->db->where('action', 'sell');
        $this->db->where('status !=', 'closed');
        
        $result = $this->db->get('buy_sell_trades')->result_array();
        return ($result);
    }

    public function portfolio_close_trade($trade_id)
    {
        // print_r($_POST);die;
        $lot = $this->input->post('lot');
        $userid = $this->session->userdata('id');
        $trade = $this->db->get_where('buy_sell_trades', ['id' => $trade_id])->row();
        $scripId = $trade->scrip_id;
        $lot_size = $trade->lot_size;
        $totalLots = $this->db->where('scrip_id', $scripId)->get('buy_sell_trades')->row()->lot;
        $avgBuyRate = number_format($this->getAverageBuyRate($scripId), 7);
        $totalAmount = $lot * $avgBuyRate * $lot_size;
        $existingAmount = $this->db->where('user_id', $userid)->get('funds')->row()->amount;
        $updatedAmount = $existingAmount + $totalAmount;
        $this->db->where('user_id', $userid)->update('funds', ['amount' => $updatedAmount]);
        $this->db->where('scrip_id', $scripId)->update('buy_sell_trades', ['status' => 'Closed']);
        $this->db->where('id', $trade_id)->update('buy_sell_trades', ['status' => 'Closed']);
        redirect('trades');
    }
    public function active_close_trade($trade_id)
    {
        $lot = $this->input->post('lot');
        // print_r($lot);die;
        $userid = $this->session->userdata('id');
        $trade = $this->db->get_where('buy_sell_trades', ['id' => $trade_id])->row();
        $scripId = $trade->scrip_id;
        $totalLots = $this->db->where('scrip_id', $scripId)->get('buy_sell_trades')->row()->lot;
        $avgBuyRate = number_format($this->getAverageBuyRate($scripId), 7);
        $totalAmount = $lot * $avgBuyRate;
        $existingAmount = $this->db->where('user_id', $userid)
                                    ->get('funds')
                                    ->row()->amount;
        $updatedAmount = $existingAmount + $totalAmount;
        $this->db->where('user_id', $userid)
                 ->update('funds', ['amount' => $updatedAmount]);
        // $this->db->where('scrip_id', $scripId)->update('buy_sell_trades', ['status' => 'Closed']);
        $this->db->where('id', $trade_id)
                 ->update('buy_sell_trades', ['status' => 'Closed']);
        redirect('trades');
    }
     
    public function cancel_trade()
    {
        $trade_id = $this->input->post('trade_id');
        $data = array(
            'status' => 'cancel'
        );
    
        $this->db->where('id', $trade_id);
        $this->db->update('buy_sell_trades', $data);
    
        $response = array(
            'success' => true,
            'message' => 'Trade closed successfully.'
        );
    
        echo json_encode($response);
    }
    
    private function getAverageBuyRate($scripId)
    {
        $query = $this->db->query("SELECT AVG(buy_rate) AS avg_buy_rate FROM buy_sell_trades WHERE buy_rate > 0 AND scrip_id = $scripId GROUP BY scrip_id");
        $result = $query->row();
        $avgBuyRate = ($result->avg_buy_rate !== null) ? number_format($result->avg_buy_rate, 2) : 'N/A';
        return $result->avg_buy_rate;
    }

    public function close_nse_equity()
    {
        // print_r($_POST);die;

        $user_id = $this->session->userdata('id');
        $password = md5($this->input->post('password'));
        $trade_type = $this->input->post('trade_type_nse');
        $scrip_id = $this->input->post('scrip_id'); 
        $scrip_ids = implode(',', $scrip_id);
        $lot = $this->input->post('lot'); 
        $buy_rate = $this->input->post('buy_rate'); 
        $total_buy_rate = array_sum($buy_rate);
        $totalLots = array_sum($lot);

        $user = $this->db
            ->select('users.password')
            ->from('users')
            ->where('users.id', $user_id)
            ->get()
            ->row();
    
        if ($password == $user->password) {
            $existingAmount = $this->db->where('user_id', $user_id)
            ->get('funds')
            ->row()->amount;                       
            $updatedAmount = $existingAmount + $total_buy_rate;
            $this->db->where('user_id', $user_id)
            ->update('funds', ['amount' => $updatedAmount]);

            $scrip_ids_array = explode(',', $scrip_ids);
            $trimmed_scrip_ids = array_map('trim', $scrip_ids_array);

            $this->db->where_in('scrip_id', $trimmed_scrip_ids)
            ->update('buy_sell_trades', array('status' => 'closed'));

    
            $this->session->set_flashdata('success', 'All NSE trades closed successfully.');
            redirect('trades');
        } else {
            $this->session->set_flashdata('error', 'Transaction password does not match.');
            redirect('trades');
        }
    }
    
    public function close_mcx_equity()
{
    $user_id = $this->session->userdata('id');
    $password = md5($this->input->post('password'));
    $trade_type = $this->input->post('trade_type');
    $scrip_id = $this->input->post('scrip_id'); 
    $scrip_ids = implode(',', $scrip_id);
    $lot = $this->input->post('lot'); 
    $buy_rate = $this->input->post('buy_rate'); 
   
    $total_buy_rate = array_sum($buy_rate);
    // print_r($total_buy_rate);
    $totalLots = array_sum($lot);
    // echo '<pre>';print_r($totalLots);
    $user = $this->db
        ->select('users.password')
        ->from('users')
        ->where('users.id', $user_id)
        ->get()
        ->row();
    // echo '<pre>';print_r($user);die;
    if ($password == $user->password) {
        $existingAmount = $this->db->where('user_id', $user_id)
                                    ->get('funds')
                                    ->row()->amount;
        $updatedAmount = $existingAmount + $total_buy_rate;
    
        $this->db->where('user_id', $user_id)
            ->update('funds', ['amount' => $updatedAmount]);
    
        $scrip_ids_array = explode(',', $scrip_ids);
        $trimmed_scrip_ids = array_map('trim', $scrip_ids_array);
    
        $this->db->where_in('scrip_id', $trimmed_scrip_ids)
                 ->where('status !=', 'pending')
                 ->update('buy_sell_trades', ['status' => 'closed']);
    
        $this->session->set_flashdata('success', 'All MCX trades closed successfully.');
        redirect('trades');
        }
        else {
            $this->session->set_flashdata('error', 'Password does not match.');
            redirect('trades');
        }
    }
    public function updateLedgerBalance()
    {
        // Get the active trades from the database
        $activeTrades = $this->db->get_where('trades', ['status' => 'active'])->result();

        foreach ($activeTrades as $trade) {
            $pl = $trade->avg_buy_rate * $trade->lot * $trade->lot_size - $trade->sell_rate * $trade->lot * $trade->lot_size;
            $ledgerBalanceChange = ($pl < 0) ? -abs($pl) : $pl;

            $this->db->set('balance', 'balance + ' . $ledgerBalanceChange, FALSE)
                ->where('trade_id', $trade->id)
                ->update('ledger_balance');
        }

        $data['message'] = 'Ledger balance updated successfully.';
        $this->load->view('ledger_balance_success', $data);
    }
    public function _is_logged_in()
    {
        return $this->session->has_userdata('username');
    }
    public function trade_detail()
    {
        $this->load->view('trade/trade_detail');
    }
}