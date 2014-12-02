<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th>
                Дата
            </th>
            <th>
                Дата закрытия
            </th>
            <th>
                Номер
            </th>
            <th>
                Чистая прибыль
            </th>
            <th>
                Инженер
            </th>
        </tr>
        <?
            $counter = 0;
            foreach($data as $order){
                $counter += (int)$order->profit;
        ?>
                <tr>
                    <td><?= date("d.m.Y",strtotime($order->date))?></td>
                    <td><?= date("d.m.Y",strtotime($order->time_close))?></td>
                    <td><a href="<?= Yii::app()->createUrl('orders/view',array('id'=>$order->id))?>"><?= $order->id_abc;?></a></td>
                    <td><?= $order->profit?></td>
                    <td><?= $order->ing->fio?></td>
                </tr>

        <?
            }
        ?>
        <tr>
            <td colspan="2">Итого:</td>
            <td colspan="2"><?= $counter;?></td>
        </tr>
    </thead>
</table>