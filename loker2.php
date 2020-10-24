<?php

$exit = false;
$jumlahLoker = 0;
$arrayData = [];
$counter = 1;
$indexLeave = 0;

do {
    
    $inputCommand = trim(fgets(STDIN));
    $explode = explode(' ', $inputCommand);

    switch ($explode[0]) {
        case 'init' :
            if (empty($explode[1])){
                echo "Masukkan jumlah Loker"."\n";
            break;
            }

            $jumlahLoker = $explode[1];
        break;
        case 'input' :
            if($jumlahLoker <= 0) {
                echo "Masukkan jumlah Loker"."\n";
            break;
            }
            
            if (empty($explode[1])){
                echo "Masukkan tipe identitas"."\n";
            break;
            }

            if (empty($explode[2])) {
                echo "Masukkan nomor identitas"."\n";
            break;
            }

            if ($counter > $jumlahLoker){
                echo "Maaf loker sudah penuh"."\n";
            break;
            }

            $data = [
                "loker" => '',
                "tipe_identitas" => '',
                "no_identitas" => '',
            ];

            for($i=0; $i <= $counter; $i++){
                $data['loker'] = $i+1;
                $data['tipe_identitas'] = $explode[1];
                $data['no_identitas'] = $explode[2];
                if(empty($arrayData[$i])){
                    $arrayData[$i] = $data;
                    echo "Kartu identitas tersimpan di loker nomor ".($i+1)."\n";
                    $counter++;
                break;
                }
            }
        break;
        case 'status' :
            echo "No Identitas      Tipe Identitas      No Identitas"."\n";
            if (!empty($arrayData)){
                sort($arrayData);
                foreach ($arrayData as $array) {
                    echo $array['loker']."                  ".$array['tipe_identitas']."                    ".$array['no_identitas']."\n";
                }
            break;
            }
        break;
        case 'leave' :
            if (empty($explode[1])){
                echo "Masukkan nomor loker yang ingin di kosongkan"."\n";
            break;
            }
            if (!empty($arrayData)){
                $nomor = $arrayData[$explode[1]-1]['loker'];
                unset($arrayData[$explode[1]-1]);
                echo "Loker nomor ".$nomor." berhasil dikosongkan \n";
                $counter--;
            break;
            }
        break;
        case 'find' :
            if (empty($explode[1])){
                echo "Masukkan nomor identitas yang ingin dicari \n";
            break;
            }

            if (!empty($arrayData)) {
                $find = false;
                foreach ($arrayData as $key => $array) {
                    if($array['no_identitas'] == $explode[1]){
                        echo "Kartu identitas tersebut berada di loker nomor ".$array['loker']."\n";
                        $find = true;
                    break;
                    }
                }
                if ($find == false) {
                    echo "Nomor identitas tidak ditemukan \n";
                break;
                }
            break;
            }
        break;
        case 'search' :
            if (empty($explode[1])){
                echo "Masukkan tipe identitas yang ingin dicari \n";
            break;
            }

            if (!empty($arrayData)) {
                $dataSearch = [];
                foreach ($arrayData as $array) {
                    if($array['tipe_identitas'] == $explode[1]){
                        array_push($dataSearch, $array['no_identitas']);
                    }
                }
                if(empty($dataSearch)){
                    echo "Tipe identitas tidak ditemukan \n";
                break;
                }
                $implode = implode(",", $dataSearch);
                echo $implode."\n";
            break;
            }
        break;
        case 'exit' :
            $exit = true;
        break;
        default :
            echo "Command tidak tersedia \n";
        break;
    }
}while($exit == false);

?>