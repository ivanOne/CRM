<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th>
                Дата
            </th>
            <th>
                Номер
            </th>
            <th>
                Чистая прибыль
            </th>
        </tr>
        <?
            $counter = 0;

            foreach($data as $order){
                $counter += (int)$order->profit;
                ?>
                <tr>
                    <td><?= date("d.m.Y",strtotime($order->date))?></td>
                    <td><?= $order->id_abc;?></td>
                    <td><?= $order->profit;?></td>
                </tr>

            <?
            }
        ?>
<tr>
    <td colspan="2">Итого:</td>
    <td><?= $counter;?></td>
</tr>
</thead>
</table>