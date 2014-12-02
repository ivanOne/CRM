<tr>
    <td><?= $data->id ?></td>
    <td><?= $data->date?></td>
    <td><?= $data->idPost->name?></td>
    <td><?= $data->coast?></td>
    <td><a href="<?= Yii::app()->createUrl('advert/advertpostdel',array('id'=>$data->id))?>">Удалить</a></td>
</tr>
