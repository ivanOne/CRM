<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>ФИО <span id="z">+</span></th>
        <th id="hid">Паспортные данные</th>
        <th id="hid">Проживание</th>
        <th id="hid">Телефон</th>
        <th id="hid">Дата рождения</th>
        <th id="hid">Дата начала работы в компании</th>
        <th>Куратор</th>
    </tr>
    </thead>
    <?
    foreach($data as $dat){
        $cura = "";
        if($dat->fio->other){
            $curator = json_decode($dat->fio->other);
            $ml = RolesUsers::getManager();
            if(array_key_exists($curator->curator ,$ml)){
                $cura = $ml[$curator->curator];
            }
        }?>
        <tr class="text-center">
            <td><? echo $dat->id_user?></td>
            <td><a href="<? echo Yii::app()->CreateUrl('employee/employeeProfile',array('id'=>$dat->id_user))?>"><? echo $dat->fio->fio?></a></td>
            <td id="hid"><? UserProfiles::getPas($data->fio->passport); ?></td>
            <td id="hid"><? echo $data->fio->propiska; ?></td>
            <td id="hid"><? echo $data->fio->telephone; ?></td>
            <td id="hid"><? echo $data->fio->dob; ?></td>
            <td id="hid"><? echo $data->fio->first_day; ?></td>
            <td><? echo $cura;?></td>
        </tr>
    <? } ?>
</table>