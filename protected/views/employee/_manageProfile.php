
<div class="col-lg-12">
    <table class="table table-bordered table-striped">
        <tr>
            <td><b>Номер</b></td>
            <td><? echo $profile->id_user;?></td>
        </tr>
        <tr>
            <td><b>ФИО</b></td>
            <td><? echo $profile->fio->fio;?></td>
        </tr>
        <tr>
            <td><b>Должность</b></td>
            <td><? echo $profile->idRole->name;?></td>
        </tr>
        <tr>
            <td><b>Телефон</b></td>
            <td><? echo $profile->fio->telephone;?></td>
        </tr>
        <tr>
            <td><b>Паспорт</b></td>
            <td><? UserProfiles::getPas($profile->fio->passport); ?></td>
        </tr>
        <tr>
            <td><b>Проживание</b></td>
            <td><? echo $profile->fio->propiska; ?></td>
        </tr>
        <tr>
            <td><b>Дата рождения</b></td>
            <td><? echo $profile->fio->dob; ?></td>
        </tr>
        <tr>
            <td><b>Дата начала работы</b></td>
            <td><? echo $profile->fio->first_day; ?></td>
        </tr>
    </table>
</div>