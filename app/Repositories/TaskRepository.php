<?php


namespace App\Repositories;


class TaskRepository
{

	var $data;

	public function __construct($request) {
		$this->data=$request->toArray();
    }

    public function get_dsr() {
        if($this->data['payment_type'] == 'Daily'){
            return $this->data['basic_pay'];
        }

        if($this->data['payment_type'] == 'Weekly'){
            if($this->data['schedule'] == 261) $sched = 5;
            else $sched = 6;

            return $this->data['basic_pay']/ $sched;
        }

        if($this->data['payment_type'] == 'Semi-Monthly'){
            return ($this->data['basic_pay'] * 2) * 12 / $this->data['schedule'];
        }

        return $this->data['basic_pay'] * 12 / $this->data['schedule'];
    }

    public function get_hsr() {
        return $this->get_dsr()/8;
    }


    public function get_phic() {
        if($this->data['payment_type'] == 'Semi-Monthly')
            $bp = $this->data['basic_pay'] * 2;
        elseif($this->data['payment_type'] == 'Weekly')
            $bp = $this->data['basic_pay'] * 4;
        else $bp = $this->data['basic_pay'];

        $contribution = 100;

        if($bp < 9000 ) return $contribution;
        if($bp > 34999.99) return 437.50;


        for ($range=9000; $range <= 34999.99 ; $range+=1000) {
            $contribution += 12.50;
            if ($bp >= $range && $bp<= $range+999.99) return $contribution;
        }


    }

    public function get_hdmf() {
        if($this->data['payment_type'] == 'Semi-Monthly')
            $bp = $this->data['basic_pay'] * 2;
        elseif($this->data['payment_type'] == 'Weekly')
            $bp = $this->data['basic_pay'] * 4;
        else $bp = $this->data['basic_pay'];

        if ($bp <= 5000) $contribution = $bp * 0.02;
        else $contribution = 100;

        return $contribution;

    }

    public function get_sss() {
        if($this->data['payment_type'] == 'Semi-Monthly')
            $bp = $this->data['basic_pay'] * 2;
        elseif($this->data['payment_type'] == 'Weekly')
            $bp = $this->data['basic_pay'] * 4;
        else $bp = $this->data['basic_pay'];

        $contribution = 36.30;
        $counter = 0;

        if($bp >= 1000 && $bp <= 1249.99) return $contribution;
        if($bp >= 15750) return 581.30;


        for ($range=1250; $range <= 15749.99 ; $range+=500) {

            if($counter < 2) {
                $contribution += 18.20;
                $counter++;            }

            else{
                $contribution += 18.10;
                $counter = 0;
            }

            if ($bp >= $range && $bp<= $range+499.99) return $contribution;

        }
    }

}


?>
