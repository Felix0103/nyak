<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\Admin\FileDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class FilesImport implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading
{

    public $FileHeaderId;

    public function __construct($fileHeaderId){
        $this->FileHeaderId = $fileHeaderId;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ( Str::upper($row['last_scan']) != "DELIVERED" ) return;

        $name_splitted = $this->splitName($row['name_and_address']);
        return new FileDetail([
            'file_header_id' => $this->FileHeaderId,
            'barcode' => $row['barcode'],
            'status' => $row['last_scan'],
            'seq_no' => $row['seq_no'],
            'name' => $name_splitted['name'],
            'address' => $name_splitted['address'],
            'zip_code' => ( isset($row['zipcode']) && strlen($row['zipcode'])>0?$row['zipcode']:$name_splitted['zipCode']),
            'active' => 1
        ]);
    }

    public function rules(): array
    {
        return [
            // 'file_header_id' => 'required',
            // 'barcode' => 'unique:file_details',
        ];
    }

    private function splitName($info){

        $raw = explode(" ",$info);
        $name =  "" ;
        $address =  "" ;
        $zipCode =  "" ;
        $posicion=0;

        foreach ($raw  as $key => $value) {

            // Verifico si este es el ultimo y compruebo si es un zipcode
            if( $key == (count($raw)-1)  && is_numeric($value)){
                $posicion++;
            }

            if( $posicion ==0){
                $name .= $value." ";
            } else if($posicion ==1){
                $address .=  $value." ";
            } else if($posicion == 2){
                $zipCode = $value;
            }

            if(Str::contains($value,'.') && $posicion ==0 ){
                $name = trim($name);
                $posicion++;
            }
            if( $key == (count($raw)-1)){
                $address =trim($address);
            }
        }

        return array('name'=> $name, 'address'=> $address, 'zipCode' => $zipCode);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int{
        return 100;
    }
}
