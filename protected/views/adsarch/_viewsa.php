<tr class="text-center">
    <td><?= $data->id_abc;?></td>
    <td><?= $data->addr;?></td>
    <td><?= date("d-m-Y",strtotime($data->date));?></td>
    <td><?= $data->region0->name?></td>
    <td><?= $data->ads?></td>
    <td><? if($data->pay == 1){
            echo "Оплачено";
        }
        else{
            echo "Оплаты нет";
        }
           ?>
    </td>
</tr>