<? $addr = json_decode($data->fio->home);
   $mes = $data->fio->city." ".$data->fio->street." ".$addr->home_num;
   $regionList = CHtml::listData(AdsRegion::model()->findAll(),'id','name');
?>

<tr class="text-center architem" ini="<?= $data->id?>">
    <td class="adsid">
        <?= $data->id_abc?>
    </td>
    <td class="adsaddr">
        <?= $mes?>
    </td>
    <td class="adsdate">
        <?= date("d-m-Y",strtotime($data->date))?>
    </td>
    <td>
        <?= CHtml::dropDownList('region',"0",$regionList,array('empty'=>"",'class'=>'form-control','ini'=>$data->id));?>
    </td>
    <td class="adsMan" ini="<?= $data->id?>">

    </td>
    <td class="adsPay" ini="<?= $data->id?>">

    </td>
</tr>