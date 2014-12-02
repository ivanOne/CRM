<tr class="text-center">
    <td><? echo $datas->id_user?></td>
    <td><a href="<? echo Yii::app()->CreateUrl('employee/employeeProfile',array('id'=>$datas->id_user))?>"><? echo $datas->fio->fio?></a></td>
    <td><? echo $cura;?></td>
</tr>