<?php


namespace App\Repositories;


class Computations {

    public function get_tax_payables($data,$ti) {
          if($data['payment_type'] == 'Monthly'){

            if ($data['dependents'] == 0) {
                if ($ti <= 4583.5) {
                    $tbase = 0;
                    $excess = $ti - 4167;
                    $tp = $tbase + ($excess * 0.05);
                } else if ($ti >= 4583.5 && $ti <= 5417) {
                    $tbase = 41.67;
                    $excess = $ti - 5000;
                    $tp = $tbase + ($excess * 0.10);
                } else if ($ti >= 5417 && $ti <= 8333.5) {
                    $tbase = 208.33;
                    $excess = $ti - 6667;
                    $tp = $tbase + ($excess * 0.15);
                } else if ($ti >= 8333.5 && $ti <= 12916.5) {
                    $tbase = 708.33;
                    $excess = $ti - 10000;
                    $tp = $tbase + ($excess * 0.20);
                } else if ($ti >= 12916.5 && $ti <= 20416.5) {
                    $tbase = 1875;
                    $excess = $ti - 15833;
                    $tp = $tbase + ($excess * 0.25);
                } else if ($ti >= 20416.5 && $ti <= 35416.5) {
                    $tbase = 4166.67;
                    $excess = $ti - 25000;
                    $tp = $tbase + ($excess * 0.30);
                } else if ($ti >= 35416.5) {
                    $tbase = 10416.67;
                    $excess = $ti - 45833;
                    $tp = $tbase + ($excess * 0.32);
                }

            }//END OF FIRST IF
            elseif ($data['dependents'] == 1) {
                if ($ti <= 6666.5) {
                    $tbase = 0;
                    $excess = $ti - 6250;
                    $tp = $tbase + ($excess * 0.05);
                } else if ($ti >= 6666.5 && $ti <= 7916.5) {
                    $tbase = 41.67;
                    $excess = $ti - 7083;
                    $tp = $tbase + ($excess * 0.10);
                } else if ($ti >= 7916.5 && $ti <= 10416.5) {
                    $tbase = 208.33;
                    $excess = $ti - 8750;
                    $tp = $tbase + ($excess * 0.15);
                } else if ($ti >= 10416.5 && $ti <= 15000) {
                    $tbase = 708.33;
                    $excess = $ti - 12083;
                    $tp = $tbase + ($excess * 0.20);
                } else if ($ti >= 15000 && $ti <= 22500) {
                    $tbase = 1875;
                    $excess = $ti - 17917;
                    $tp = $tbase + ($excess * 0.25);
                } else if ($ti >= 22500 && $ti <= 37500) {
                    $tbase = 4166.67;
                    $excess = $ti - 27083;
                    $tp = $tbase + ($excess * 0.30);
                } else if ($ti >= 37500) {
                    $tbase = 10416.67;
                    $excess = $ti - 47917;
                    $tp = $tbase + ($excess * 0.32);
                }

            }//END OF SECOND IF
           elseif ($data['dependents'] == 2) {
                if ($ti <= 8750) {
                    $tbase = 0;
                    $excess = $ti - 8333;
                    $tp = $tbase + ($excess * 0.05);
                } else if ($ti >= 8750 && $ti <= 10000) {
                    $tbase = 41.67;
                    $excess = $ti - 9167;
                    $tp = $tbase + ($excess * 0.10);
                } else if ($ti >= 10000 && $ti <= 12500) {
                    $tbase = 208.33;
                    $excess = $ti - 10833;
                    $tp = $tbase + ($excess * 0.15);
                } else if ($ti >= 12500 && $ti <= 17083.5) {
                    $tbase = 708.33;
                    $excess = $ti - 14167;
                    $tp = $tbase + ($excess * 0.20);
                } else if ($ti >= 17083.5 && $ti <= 24583.5) {
                    $tbase = 1875;
                    $excess = $ti - 20000;
                    $tp = $tbase + ($excess * 0.25);
                } else if ($ti >= 24583.5 && $ti <= 39583.5) {
                    $tbase = 4166.67;
                    $excess = $ti - 29167;
                    $tp = $tbase + ($excess * 0.30);
                } else if ($ti >= 39583.5) {
                    $tbase = 10416.67;
                    $excess = $ti - 50000;
                    $tp = $tbase + ($excess * 0.32);
                }

            }//END OF 3RD IF
            elseif ($data['dependents'] == 3) {
                if ($ti <= 10833.5) {
                    $tbase = 0;
                    $excess = $ti - 10417;
                    $tp = $tbase + ($excess * 0.05);
                } else if ($ti >= 10833.5 && $ti <= 12083.5) {
                    $tbase = 41.67;
                    $excess = $ti - 11250;
                    $tp = $tbase + ($excess * 0.10);
                } else if ($ti >= 12083.5 && $ti <= 14583.5) {
                    $tbase = 208.33;
                    $excess = $ti - 12917;
                    $tp = $tbase + ($excess * 0.15);

                } else if ($ti >= 14583.5 && $ti <= 19167) {
                    $tbase = 708.33;
                    $excess = $ti - 16250;
                    $tp = $tbase + ($excess * 0.20);
                } else if ($ti >= 19167 && $ti <= 26667) {
                    $tbase = 1875;
                    $excess = $ti - 22083;
                    $tp = $tbase + ($excess * 0.25);
                } else if ($ti >= 26667 && $ti <= 41667) {
                    $tbase = 4166.67;
                    $excess = $ti - 31250;
                    $tp = $tbase + ($excess * 0.30);
                } else if ($ti >= 41667) {
                    $tbase = 10416.67;
                    $excess = $ti - 52083;
                    $tp = $tbase + ($excess * 0.32);
                }

            }//END OF 4TH IF
            elseif ($data['dependents'] >= 4) {
                if ($ti <= 12916.5) {
                    $tbase = 0;
                    $excess = $ti - 12500;
                    $tp = $tbase + ($excess * 0.05);
                } else if ($ti >= 12916.5 && $ti <= 14166.5) {
                    $tbase = 41.67;
                    $excess = $ti - 13333;
                    $tp = $tbase + ($excess * 0.10);
                } else if ($ti >= 14166.5 && $ti <= 16666.5) {
                    $tbase = 208.33;
                    $excess = $ti - 15000;
                    $tp = $tbase + ($excess * 0.15);
                } else if ($ti >= 16666.5 && $ti <= 21250) {
                    $tbase = 708.33;
                    $excess = $ti - 18333;
                    $tp = $tbase + ($excess * 0.20);
                } else if ($ti >= 21250 && $ti <= 28750) {
                    $tbase = 1875;
                    $excess = $ti - 24167;
                    $tp = $tbase + ($excess * 0.25);
                } else if ($ti >= 28750 && $ti <= 43750) {
                    $tbase = 4166.67;
                    $excess = $ti - 33333;
                    $tp = $tbase + ($excess * 0.30);
                } else if ($ti >= 43750) {
                    $tbase = 10416.67;
                    $excess = $ti - 54167;
                    $tp = $tbase + ($excess * 0.32);
                }

            }
        }


        /*--------------------------------------------------------------------------
            SEMI MONTHLY
        --------------------------------------------------------------------------*/

        if($data['payment_type'] == 'Semi-Monthly') {
            if ($data['dependents'] == 0) {
                if ($ti <= 2291.5) {
                    $tbase = 0;
                    $excess = $ti - 2083;
                    $tp = $tbase + ($excess * 0.05);
                } else if ($ti >= 2291.5 && $ti <= 2916.5) {
                    $tbase = 20.83;
                    $excess = $ti - 2500;
                    $tp = $tbase + ($excess * 0.10);
                } else if ($ti >= 2916.5 && $ti <= 4166.5) {
                    $tbase = 104.17;
                    $excess = $ti - 3333;
                    $tp = $tbase + ($excess * 0.15);
                } else if ($ti >= 4166.5 && $ti <= 6458.5) {
                    $tbase = 354.17;
                    $excess = $ti - 5000;
                    $tp = $tbase + ($excess * 0.20);
                } else if ($ti >= 6458.5 && $ti <= 10208.5) {
                    $tbase = 937.50;
                    $excess = $ti - 7917;
                    $tp = $tbase + ($excess * 0.25);
                } else if ($ti >= 10208.5 && $ti <= 17708.5) {
                    $tbase = 2083.33;
                    $excess = $ti - 12500;
                    $tp = $tbase + ($excess * 0.30);
                } else if ($ti >= 17708.5) {
                    $tbase = 5208.33;
                    $excess = $ti - 22917;
                    $tp = $tbase + ($excess * 0.32);
                }

            }//END OF SEMI 1ST IF
            elseif ($data['dependents'] == 1) {
                if ($ti <= 3333.5) {
                    $tbase = 0;
                    $excess = $ti - 3125;
                    $tp = $tbase + ($excess * 0.05);
                } else if ($ti >= 3333.5 && $ti <= 3958.5) {
                    $tbase = 20.83;
                    $excess = $ti - 3542;
                    $tp = $tbase + ($excess * 0.10);
                } else if ($ti >= 3958.5 && $ti <= 5208.5) {
                    $tbase = 104.17;
                    $excess = $ti - 4375;
                    $tp = $tbase + ($excess * 0.15);
                } else if ($ti >= 5208.5 && $ti <= 7500) {
                    $tbase = 354.17;
                    $excess = $ti - 6042;
                    $tp = $tbase + ($excess * 0.20);
                } else if ($ti >= 7500 && $ti <= 11250) {
                    $tbase = 937.50;
                    $excess = $ti - 8958;
                    $tp = $tbase + ($excess * 0.25);
                } else if ($ti >= 11250 && $ti <= 18750) {
                    $tbase = 2083.33;
                    $excess = $ti - 13542;
                    $tp = $tbase + ($excess * 0.30);
                } else if ($ti >= 18750) {
                    $tbase = 5208.33;
                    $excess = $ti - 23958;
                    $tp = $tbase + ($excess * 0.32);
                }

            }//END OF SEMI 2ND IF
            elseif ($data['dependents'] == 2) {
                if ($ti <= 4375) {
                    $tbase = 0;
                    $excess = $ti - 4167;
                    $tp = $tbase + ($excess * 0.05);
                } else if ($ti >= 4375 && $ti <= 5000) {
                    $tbase = 20.83;
                    $excess = $ti - 4583;
                    $tp = $tbase + ($excess * 0.10);
                } else if ($ti >= 5000 && $ti <= 6250) {
                    $tbase = 104.17;
                    $excess = $ti - 5417;
                    $tp = $tbase + ($excess * 0.15);
                } else if ($ti >= 6250 && $ti <= 8541.5) {
                    $tbase = 354.17;
                    $excess = $ti - 7083;
                    $tp = $tbase + ($excess * 0.20);
                } else if ($ti >= 8541.5 && $ti <= 12291.5) {
                    $tbase = 937.50;
                    $excess = $ti - 10000;
                    $tp = $tbase + ($excess * 0.25);
                } else if ($ti >= 12291.5 && $ti <= 19791.5) {
                    $tbase = 2083.33;
                    $excess = $ti - 14583;
                    $tp = $tbase + ($excess * 0.30);
                } else if ($ti >= 19791.5) {
                    $tbase = 5208.33;
                    $excess = $ti - 25000;
                    $tp = $tbase + ($excess * 0.32);
                }

            }//END OF SEMI 3RD IF
            elseif ($data['dependents'] == 3) {
                if ($ti <= 5416.5) {
                    $tbase = 0;
                    $excess = $ti - 5208;
                    $tp = $tbase + ($excess * 0.05);
                } else if ($ti >= 5416.5 && $ti <= 6041.5) {
                    $tbase = 20.83;
                    $excess = $ti - 5625;
                    $tp = $tbase + ($excess * 0.10);
                } else if ($ti >= 6041.5 && $ti <= 7291.5) {
                    $tbase = 104.17;
                    $excess = $ti - 6458;
                    $tp = $tbase + ($excess * 0.15);
                } else if ($ti >= 7291.5 && $ti <= 9583) {
                    $tbase = 354.17;
                    $excess = $ti - 8125;
                    $tp = $tbase + ($excess * 0.20);
                } else if ($ti >= 9583 && $ti <= 13333) {
                    $tbase = 937.50;
                    $excess = $ti - 11042;
                    $tp = $tbase + ($excess * 0.25);
                } else if ($ti >= 13333 && $ti <= 20833) {
                    $tbase = 2083.33;
                    $excess = $ti - 15625;
                    $tp = $tbase + ($excess * 0.30);
                } else if ($ti >= 20833) {
                    $tbase = 5208.33;
                    $excess = $ti - 26042;
                    $tp = $tbase + ($excess * 0.32);
                }
            }//END OF SEMI 4TH IF
            elseif ($data['dependents'] >= 4) {
                if ($ti <= 6458.5) {
                    $tbase = 0;
                    $excess = $ti - 6250;
                    $tp = $tbase + ($excess * 0.05);
                } else if ($ti >= 6458.5 && $ti <= 7083.5) {
                    $tbase = 20.83;
                    $excess = $ti - 6667;
                    $tp = $tbase + ($excess * 0.10);
                } else if ($ti >= 7083.5 && $ti <= 8333.5) {
                    $tbase = 104.17;
                    $excess = $ti - 7500;
                    $tp = $tbase + ($excess * 0.15);
                } else if ($ti >= 8333.5 && $ti <= 10625) {
                    $tbase = 354.17;
                    $excess = $ti - 9167;
                    $tp = $tbase + ($excess * 0.20);
                } else if ($ti >= 10625 && $ti <= 14375) {
                    $tbase = 937.50;
                    $excess = $ti - 12083;
                    $tp = $tbase + ($excess * 0.25);
                } else if ($ti >= 14375 && $ti <= 21875) {
                    $tbase = 2083.33;
                    $excess = $ti - 16667;
                    $tp = $tbase + ($excess * 0.30);
                } else if ($ti >= 21875) {
                    $tbase = 5208.33;
                    $excess = $ti - 27083;
                    $tp = $tbase + ($excess * 0.32);
                }
            }//END OF SEMI 4TH IF
        }


        return $tp;
    }
}


?>
