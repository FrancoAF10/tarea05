<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2 align="center">Super heroe- Super poder</h2>
    <table border="1" style="width: 100%; max-width: 800px; margin: auto; border-collapse: collapse;">
        <colgroup>
            <col style="width:5%">
            <col style="width:25%">
            <col style="width:70%">
        </colgroup>
        <thead>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Super Poder</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rows as $row): ?>
                <tr>
                <td><?=$row['id']?></td>
                <td><?=$row['superhero_name']?></td>
                <td><?=$row['powers']?></td>
                </tr>
            <?php endforeach;?>  
        </tbody>
    </table>
</body>
</html>