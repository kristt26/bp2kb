<html>

<head>
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #000000;
        text-align: center;
        height: 20px;
        margin: 8px;
    }
    </style>
</head>

<body>
    <?php if($id=='1'):?>
    <h5 style="font-size:12px; text-align: center;">PENDATAAN PENDUDUK
        <br>KABUPATEN JAYAPURA
    </h5>
    <?php endif;?>
    <h4><?= 'Distrik ' . $kecamatan?>
    </h4>
    <table cellpadding="6">
        <tr>
            <th>No</th>
            <th>Kelurahan</th>
            <th>Total RW</th>
            <th>Total RT</th>
            <th>Total KK</th>
            <th>Total Penduduk Laki-laki</th>
            <th>Total Penduduk Perempuan</th>
        </tr>
        <?php foreach($kelurahan as $key=>$value):?>
        <tr>
            <td scope="row"><?= $key+1?></td>
            <td><?= $value['kelurahan']?></td>
            <td><?= $value['rw']?></td>
            <td><?= $value['rt']?></td>
            <td><?= $value['kk']?></td>
            <td><?= $value['pria']?></td>
            <td><?= $value['wanita']?></td>
        </tr>
        <?php endforeach;?>
    </table>
</body>

</html>