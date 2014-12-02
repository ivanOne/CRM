<?
$content = "<div class='row' ><div class='col-lg-1 col-lg-offset-11'><i id='off' class='fa fa-times fa-2x'></i>
</div></div>";
$addr = json_decode($data->fio->home);
$class = 'default';
$time = null;
if($data->time){
    if($data->time == "0000-00-00 00:00:00"){
        $time = "00.00.0000 00:00";
    }
    else{
        $time ="Выезд ".date("H:i d-m-Y",strtotime($data->time));
    }

}
else{
    $time = "Офис";
}

switch ($data->status){
    case 1:
        $class = "new";
        break;
    case 2:
        $class = "inJob";
        break;
    case 3:
        $class = "made";
        break;
    case (4 or 5):
        $class = "cancel";
        break;
}
?>
<tr class="<? echo $class ?>" id="<? echo $data->id;?>" >
    <td><a href="<? echo Yii::app()->createUrl('orders/view',array('id'=>$data->id));?>"><? echo $data->id_abc;?></a></td>
    <td><? echo $data->stat->name;?></td>
    <td><? echo date('d.m.y',strtotime($data->date));?></td>
    <td ><? echo $data->fio->fio;?></td>
    <td><? echo $data->technics;?></td>
    <td><? echo $data->problem;?></td>
    <td><? echo $data->fio->telnum;?></td>
    <td><? echo $data->fio->city.", ".$data->fio->street." ".$addr->home_num?></td>
    <td><? if(isset($data->couriers)) echo $data->couriers->fio;?></td>
    <td><? if(isset($data->ing)) echo $data->ing->fio;?></td>
    <? if($data->manager != 0){ ?>
    <td><?= $data->man->fio;?></td>
    <? }
        else{
    ?>
            <td>Call-center</td>
    <?}?>
    <td><?= $time;?></td>
</tr>